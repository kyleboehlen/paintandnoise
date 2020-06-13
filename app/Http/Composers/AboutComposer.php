<?php

namespace App\Http\Composers;

use Illuminate\View\View;

class AboutComposer
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
            'stylesheet' => 'about',
        ]);
    }
}