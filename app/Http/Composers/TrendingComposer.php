<?php

namespace App\Http\Composers;

use Illuminate\View\View;

class TrendingComposer
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
            'nav_highlight' => 'trending',
        ]);
    }
}