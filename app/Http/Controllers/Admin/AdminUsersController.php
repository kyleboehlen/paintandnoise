<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Log;
use Str;

// Models
use App\Models\Admin\AdminUsers;

// Requests
use App\Http\Requests\Admin\Users\IndexRequest;
use App\Http\Requests\Admin\Users\RedirectRequest;
use App\Http\Requests\Admin\Users\ViewRequest;
use App\Http\Requests\Admin\Users\CreateRequest;

// Rules
use App\Rules\Admin\AdminUserId;

class AdminUsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
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

        // Redirect if validation fails
        if($validator->fails())
        {
            return redirect()->route('admin.users');
        }
        
        // Generate selected user
        $user = AdminUsers::find($id);

        // Return selected admin user
        return view('admin.users')->with([
            'card_header' => "User: $user->name",
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
}
