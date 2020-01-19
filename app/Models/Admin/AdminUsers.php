<?php

namespace App\Models\Admin;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

// Models
use App\Models\Admin\AdminTools;
use App\Models\Admin\AdminPerissions;
use App\Models\Admin\AdminUsersPermissions;

class AdminUsers extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

    protected $guard = 'admin';

    protected $fillable = [
        'name', 'email', 'password',
    ];

    protected $hidden = [
        'password',
    ];

    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }

    /**
     * Generate a new password reset token
     *
     * @param void
     * @return void
     */
    public function newResetPasswordToken()
    {
        return app('auth.password.broker')->createToken($this);
    }

    /**
     * Get array of permissions for admin user
     * 
     * @return array
     */
    public function permissions()
    {
        return AdminUsersPermissions::where('admin_users_id', $this->id)->get()->pluck('admin_permissions_id')->toArray();
    }

    /**
     * Assign an AdminUser Permissions
     * 
     * @param mixed $permission_ids
     * @param Carbon $expire
     * @return bool
     */
    public function assignPermissions($permission_ids, $expire = null)
    {
        if(is_array($permission_ids))
        {
            foreach($permission_ids as $permission_id)
            {
                if(!$this->assignPermission($permission_id, $expire))
                {
                    return false;
                }
            }
        }
        else
        {
            return $this->assignPermission($permission_ids, $expire);
        }

        return true;
    }

    /**
     * Assign an AdminUser a Permission
     * 
     * @param int $permission_id
     * @param Carbon $expire
     * @return bool
     */
    private function assignPermission($permission_id, $expire = null)
    {
        $admin_user_permission = AdminUsersPermissions::withTrashed()->where('admin_users_id', $this->id)->where('admin_permissions_id', $permission_id)->first();

        if(!is_null($admin_user_permission))
        {
            $admin_user_permission->deleted_at = null;
            $admin_user_permission->expires = (is_null($expire) ? $expire : $expire->toDatetimeString());
        }
        else
        {
            $admin_user_permission = new AdminUsersPermissions([
                'admin_users_id' => $this->id,
                'admin_permissions_id' => $permission_id,
                'expires' => (is_null($expire) ? $expire : $expire->toDatetimeString()),
            ]);
        }

        return $admin_user_permission->save();
    }

    /**
     * Revoke an AdminUser Permissions
     * 
     * @param mixed $permission_ids
     * @param Carbon $expire
     * @return bool
     */
    public function revokePermissions($permission_ids, $expire = null)
    {
        if(is_array($permission_ids))
        {
            foreach($permission_ids as $permission_id)
            {
                if(!$this->revokePermission($permission_id, $expire))
                {
                    return false;
                }
            }
            for($i = 0; $i < count($permission_ids); $i++)
            {
                if(!$this->revokePermission($permission_ids[$i], $expire))
                {
                    return false;
                }
            }
        }
        else
        {
            return $this->revokePermission($permission_ids, $expire);
        }

        return true;
    }

    /**
     * Revoke an AdminUser a Permission
     * 
     * @param int $permission_id
     * @return bool
     */
    private function revokePermission($permission_id)
    {
        $admin_user_permission = AdminUsersPermissions::where('admin_users_id', $this->id)->where('admin_permissions_id', $permission_id)->first();

        if(is_null($admin_user_permission))
        {
            return true; // Confirming admin does not have permission
        }

        return $admin_user_permission->delete();
    }

    /**
     * Check if admin user has a certain permission
     *
     * @param mixed
     * @return bool
     */
    public function checkPermissions($permissions)
    {
        if(is_array($permissions))
        {
            foreach($permissions as $permission)
            {
                if($this->checkPermission($permission))
                {
                    return true;
                }
            }
        }
        else
        {
            return $this->checkPermission($permissions);
        }

        return false;
    }

    /**
     * Check if admin user has a certain permission
     *
     * @param int
     * @return bool
     */
    private function checkPermission($permission)
    {
        return in_array($permission, $this->permissions());
    }

    /**
     * Get tools admin user has permissions under
     *
     * @return mixed
     */
    public function tools()
    {
        return AdminTools::whereIn('id',
            AdminPermissions::whereIn('id', 
                $this->permissions()
            )->pluck('tools_id')->toArray()
        )->get()->sortBy('name');
    }
}