<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

// Models
use App\Models\Categories\Categories;
use App\Models\Posts\Posts;

// Rules
use App\Rules\Account\CategoriesSlug;

class TopController extends Controller
{
    /** PUBLIC FUNCTIONS */
    public function index()
    {
        return view('top')->with([
            'parent_categories' => Categories::whereNull('parent_id')->get(),
        ]);
    }

    public function viewCategory($category_slug)
    {
        // Validate is a valid slug
        $validator = Validator::make(['category-slug' => $category_slug], [
            'category-slug' => ['required', new CategoriesSlug]
        ]);

        if($validator->fails())
        {
            return redirect()->route('top')->withErrors($validator);
        }

        // Populate slugs and hydrate category from id
        $slugs = config('categories.slugs');
        $category = Categories::where('id', array_search($category_slug, $slugs))->with('subCategories')->first();

        // Query top posts for the requested category
        $posts = Posts::where('categories_id', $category->id);
        
        // Also check sub categories if the requested category is a parent category with subcategories
        if(is_null($category->parent_id) && $category->subCategoriesCount() > 0)
        {
            $posts = $posts->orWhereIn('categories_id', collect($category->subCategories)->pluck('id')->toArray());
        }

        // Return top blade template with top posts for requested category
        return view('top')->with([
            'posts' => $posts->orderBy('total_votes', 'desc')->simplePaginate(config('posts.paginate')),
        ]);
    }
}
