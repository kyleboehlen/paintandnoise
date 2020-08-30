<?php

namespace App\View\Components;

use Illuminate\View\Component;

class MainNav extends Component
{
    /**
     * The highlighted nav list item.
     *
     * @var string
     */
    public $highlight;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($highlight)
    {
        $this->highlight = $highlight;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.main-nav');
    }
}
