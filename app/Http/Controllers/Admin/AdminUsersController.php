<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use Validator;
use Log;
use Str;

// Models
use App\Models\Admin\AdminUsers;
use App\Models\Admin\AdminPermissions;
use App\Models\Admin\AdminUsersPermissions;

// Requests
use App\Http\Requests\Admin\Users\IndexRequest;
use App\Http\Requests\Admin\Users\RedirectRequest;
use App\Http\Requests\Admin\Users\ViewRequest;
use App\Http\Requests\Admin\Users\CreateRequest;
use App\Http\Requests\Admin\Users\UpdateRequest;
use App\Http\Requests\Admin\Users\DeleteRequest;
use App\Http\Requests\Admin\Users\ResetPasswordRequest;

// Rules
use App\Rules\Admin\AdminUserId;

class AdminUsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function __get($admin)
    {
        return \Auth::guard('admin')->user();
    }

    public function index(IndexRequest $request)
    {
        return view('admin.users')->with([
            'show' => 'index',
        ]);
    }

    public function redirect(RedirectRequest $request)
    {
        // Return view for requested admin user
        return redirect()->route('admin.users.view', $request->get('user-id'));
    }

    public function view(ViewRequest $request, $id)
    {
        if(!$this->validateAdminUserId($id))
        {
            Log::error('Could not validate admin user by id for view.', [
                'id' => $id,
                'requesting_admin_id' => $this->admin->id,
                'requesting_admin_name' => $this->admin->name,
            ]);
            return redirect()->route('admin.users');
        }
        
        // Generate selected user
        $user = AdminUsers::find($id);

        // Return selected admin user
        return view('admin.users')->with([
            'show' => 'view',
            'user' => $user,
        ]);
    }

    public function create(CreateRequest $request)
    {
        // Create new Admin User
        $user = new AdminUsers([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt(Str::random(16)),
        ]);

        // Save new Admin User
        if($user->save())
        {
            // Log creation
            Log::info("Created admin user $user->name", [
                'user_id' => $user->id,
                'email' => $user->email,
            ]);
        }
        else
        {
            // Log failure
            Log::warning("Failed to create admin user $user->name", [
                'user_id' => $user->id,
                'email' => $user->email,
            ]);
        }

        return redirect()->route('admin.users.view', $user->id);
    }

    public function update(UpdateRequest $request, $id)
    {
        // Validate admin user id from route
        if(!$this->validateAdminUserId($id))
        {
            Log::error('Could not validate admin user by id for updating permissions', [
                'id' => $id,
                'requesting_admin_id' => $this->admin->id,
                'requesting_admin_name' => $this->admin->name,
            ]);
            return redirect()->route('admin.users');
        }

        // Get user
        $user = AdminUsers::find($id);

        // Create permissions array
        if($request->has('permissions'))
        {
            $permissions_array = $request->get('permissions');
        }
        else
        {
            $permissions_array = array();
        }

        // Get any current permissions
        $current_permissions = $user->permissions($collection = true);

        // Check current permissions
        if(!is_null($current_permissions))
        {
            foreach($current_permissions as $current_permission)
            {
                if(!in_array($current_permission, $permissions_array))
                {
                    $admin_users_permission = AdminUsersPermissions::where('users_id', $id)->where('permissions_id', $current_permission->id)->first();

                    if(!$admin_users_permission->delete())
                    {
                        Log::error("Failed to delete permission for admin $user->name", [
                            'id' => $id,
                            'requesting_admin_id' => $this->admin->id,
                            'requesting_admin_name' => $this->admin->name,
                            'permissions_id' => $current_permission->id,
                        ]);
                    }
                }
            }
        }

        // Add Permissions
        foreach($permissions_array as $permission_id)
        {
            $permission = AdminPermissions::find($permission_id);

            if(!is_null($permission))
            {
                $admin_users_permission = AdminUsersPermissions::withTrashed()->where('users_id', $id)->where('permissions_id', $permission->id)->first();

                if(is_null($admin_users_permission))
                {
                    $attributes_array = [
                        'users_id' => $user->id,
                        'permissions_id' => $permission->id,
                    ];
    
                    if($request->has('expires'))
                    {
                        array_push($attributes_array, [
                            'expires' => $request->get('expires'),
                        ]);
                    }
    
                    $admin_users_permission = new AdminUsersPermissions($attributes_array);
                }
                else
                {
                    $admin_users_permission->deleted_at = null;
                }


                if(!$admin_users_permission->save())
                {
                    Log::error("Failed to save permission for admin $user->name", [
                        'id' => $id,
                        'requesting_admin_id' => $this->admin->id,
                        'requesting_admin_name' => $this->admin->name,
                        'permissions_id' => $permission->id,
                    ]);
                }
            }
        }

        // Return view
        return redirect()->route('admin.users.view', $id);
    }

    public function delete(DeleteRequest $request, $id)
    {
        // Validate admin user id from route
        if(!$this->validateAdminUserId($id))
        {
            Log::error('Could not validate admin user by id for deletion.', [
                'id' => $id,
                'requesting_admin_id' => $this->admin->id,
                'requesting_admin_name' => $this->admin->name,
            ]);
            return redirect()->route('admin.users');
        }

        // Fetch and delete admin user
        $user = AdminUsers::find($id);
        if($user->delete())
        {
            $admin = $this->admin;
            Log::info("$admin->name deleted admin user $user->name by id.", [
                'id' => $id,
                'requesting_admin_id' => $admin->id,
            ]);
            return redirect()->route('admin.users');
        }
        
        Session::flash('failed-deletion', true);
        Log::error('Failed to delete admin user by id', [
            'id' => $id,
            'requesting_admin_id' => $this->admin->id,
            'requesting_admin_name' => $this->admin->name,
        ]);
        return redirect()->route('admin.users.view', $user->id);
    }

    public function resetPassword(ResetPasswordRequest $request, $id)
    {
        // Validate admin user id from route
        if(!$this->validateAdminUserId($id))
        {
            Log::error('Could not validate admin user by id to send a password reset email.', [
                'id' => $id,
                'requesting_admin_id' => $this->admin->id,
                'requesting_admin_name' => $this->admin->name,
            ]);
            return redirect()->route('admin.users');
        }

        // Generate password reset
        $user = AdminUsers::find($id);
        $user->sendPasswordResetNotification($user->newResetPasswordToken());

        // Log event
        $admin = $this->admin;
        Session::flash('sent', true);
        Log::info("$admin->name generated password reset token and notifcation for admin $user->name.", [
            'id' => $id,
            'admin_id' => $admin->id,
        ]);

        // Return redirect with the success status alert
        return redirect()->route('admin.users.view', $id);
    }

    private function validateAdminUserId($id)
    {
        // Set user-id for validation
        $input = [
            'user-id' => $id,
        ];

        // Set validation rules
        $rules = [
            'user-id' => ['required', 'numeric', new AdminUserId,],
        ];

        // Create validator for user id
        $validator = Validator::make($input, $rules);

        return $validator->passes();
    }
}
