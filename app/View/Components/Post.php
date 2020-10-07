<?php

namespace App\View\Components;

use Illuminate\View\Component;

// Constants
use App\Http\Helpers\Constants\Posts\Types;

// Models
use App\Models\Categories\Categories;
use App\Models\Posts\Posts;

class Post extends Component
{
    public $category_link;
    public $id;
    public $post;
    public $types = Types::class;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($id, Posts $post, $link)
    {
        $this->id = $id; // ID on page for anchor tags #
        $this->post = $post; // Post object
        $this->category_link = (bool) $link; // Whether or not the category header links to more posts of that category
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.post');
    }
}
