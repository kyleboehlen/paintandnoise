<?php

namespace App\Http\Composers\Admin;

use Illuminate\View\View;

class HomeComposer
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
            'tools' => \Auth::guard('admin')->user()->tools(),
            'stylesheet' => 'admin',
        ]);
    }
}