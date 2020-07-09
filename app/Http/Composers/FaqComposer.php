<?php

namespace App\Http\Composers;

use Illuminate\View\View;

// Models
use App\Models\Faqs;

class FaqComposer
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
            'faqs' => Faqs::all(),
            'secondary_title' => 'FAQ',
            'stylesheet' => 'faq'
        ]);
    }
}