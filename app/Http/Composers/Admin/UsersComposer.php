<?php

namespace App\Http\Composers\Admin;

use Illuminate\View\View;

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
            'stylesheet' => 'admin',
        ]);
    }
}