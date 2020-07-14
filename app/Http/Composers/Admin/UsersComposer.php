<?php

namespace App\Http\Composers\Admin;

use Illuminate\View\View;

// Models
use App\Models\Admin\AdminPermissions;
use App\Models\Admin\AdminUsers;

// Permissions
use App\Http\Helpers\Constants\Admin\Permissions;

class UsersComposer
{
    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with([
            'admin' => \Auth::guard('admin')->user(),
            'admin_permissions' => AdminPermissions::class,
            'admin_users' => AdminUsers::class,
            'permissions' => Permissions::class,
            'stylesheet' => 'admin',
        ]);
    }
}