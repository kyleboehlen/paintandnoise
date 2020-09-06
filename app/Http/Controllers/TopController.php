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
        // Check if a user is authenticated
        $auth = \Auth::check();

        // Get parent categories filtered by users categories if user logged in and get NSFW status
        $categories = Categories::whereNull('parent_id');
        $nsfw = false;
        if($auth)
        {
            $user = \Auth::user();
            $nsfw = $user->show_nsfw;
            $users_categories_ids = $user->categoriesIdsArray();
            $categories = $categories->whereIn('id', $users_categories_ids);
        }

        // Get top posts for each category
        $posts = collect();
        foreach($categories->get() as $category)
        {
            // Check if parent has subcategories
            if($category->subCategoriesCount() > 0)
            {   
                $filter_categories_ids = array();
                $sub_categories_ids = $category->subCategories()->pluck('id')->toArray();

                // Filter by users subcategories
                if($auth)
                {
                    $filter_categories_ids = array_intersect($sub_categories_ids, $users_categories_ids);
                }

                // Populate filter categories if it's still empty
                if(empty($filter_categories_ids))
                {
                    $filter_categories_ids = $sub_categories_ids;
                }

                $top_post = Posts::whereIn('categories_id', $filter_categories_ids);
            }
            else
            {
                $top_post = Posts::where('categories_id', $category->id);
            }

            // Check for NSFW filtering
            if(!$nsfw)
            {
                $top_post = $top_post->where('nsfw', $nsfw);
            }

            // Get top post
            $top_post = $top_post->with('poster')->with('category')->orderBy('total_votes', 'desc')->first();

            // Replace category name w/ parent category name
            $top_post->category['name'] = $category->name;

            // Push top post to collection
            $posts->add($top_post);
        }

        return view('top')->with([
            'posts' => $posts,
        ]);
    }

    public function viewCategory($category_slug)
    {
        // Send to sign up page if user not authenticated
        if(!\Auth::user())
        {
            return redirect()->route('login');
        }

        // Validate is a valid slug
        $validator = Validator::make(['category-slug' => $category_slug], [
            'category-slug' => ['required', new CategoriesSlug]
        ]);

        if($validator->fails())
        {
            return redirect()->route('top')->withErrors($validator);
        }

        // Get user and users categories
        $user = \Auth::user();

        // Populate slugs and hydrate category from id
        $slugs = config('categories.slugs');
        $category = Categories::where('id', array_search($category_slug, $slugs))->with('subCategories')->first();

        // Check if parent has subcategories
        if($category->subCategoriesCount() > 0)
        {   
            $sub_categories_ids = $category->subCategories()->pluck('id')->toArray();
            $filter_categories_ids = array_intersect($sub_categories_ids, $user->categoriesIdsArray());

            // Populate filter categories if it's still empty
            if(empty($filter_categories_ids))
            {
                $filter_categories_ids = $sub_categories_ids;
            }

            $posts = Posts::whereIn('categories_id', $filter_categories_ids);
        }
        else
        {
            $posts = Posts::where('categories_id', $category->id);
        }

        // Check for NSFW filtering
        if(!$user->show_nsfw)
        {
            $posts = $posts->where('nsfw', $user->show_nsfw);
        }

        // Return top blade template with top posts for requested category
        return view('top')->with([
            'posts' => $posts->orderBy('total_votes', 'desc')->simplePaginate(config('posts.paginate')),
        ]);
    }
}
