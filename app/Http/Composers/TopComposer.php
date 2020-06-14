<?php

namespace App\Http\Composers;

use Illuminate\View\View;

class TopComposer
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
            'stylesheet' => 'top',
        ]);
    }
}