<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Requests
use App\Http\Requests\Account\ShowCategoriesRequest;
use App\Http\Requests\Account\UpdateCategoriesRequest;

// Models
use App\Models\Categories\Categories;
use App\Models\Categories\UsersCategories;

class AccountManagementController extends Controller
{
    /** PUBLIC FUNCTIONS */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('verified');
    }

    public function index()
    {
        // Switch to log out button
        $show = ['log_out_link', ];

        return view('account.index')->with(['show' => $show]);
    }

    public function showCategories($parent_id = false)
    {
        // Get all parent categories
        $parent_categories = Categories::whereNull('parent_id')->get();

        // Get users categories
        $users_categories = \Auth::user()->categoriesIdsArray();

        // Order by number of users
        $parent_categories = $parent_categories->sort(function($a, $b){
            if ($a->usersCount() == $b->usersCount()) {
                return 0;
            }
            return ($a->usersCount() < $b->usersCount()) ? -1 : 1;
        })->values();

        // Parent categories returned if parent id isn't set
        if($parent_id === false)
        {
            $categories = $parent_categories;
            $index = 0;
        }
        else
        {
            // Search for the index of the parent category with an id matching param
            if(($index = $parent_categories->search(function($category) use ($parent_id){
                    return $category->id == $parent_id;
            })) !== false)
            {
                // Get parent id subcategories
                $categories = $parent_categories[$index]->subCategories()->sortBy(function($category){
                    return $category->usersCount();
                });

                // If no subcategories send back to parent categories list
                if(is_null($categories))
                {
                    return redirect()->route('account.categories');
                }
            }
            else
            {
                // Parent category not founding, redirecting to parent categories list
                return redirect()->route('account.categories');
            }
        }

        // Set next parent category
        $next_parent_category = $this->nextParentCategory($parent_categories, ++$index);

        // Redirect if they're not following that sub category
        if($parent_id !== false && !in_array($parent_id, $users_categories))
        {
            if(is_null($next_parent_category))
            {
                return redirect()->route('root');
            }
            else
            {
                return redirect()->route('account.subcategories', $next_parent_category->id);
            }
        }
        
        // Return view with data
        return view('account.categories')->with(
            [
                'categories' => $categories,
                'parent_id' => $parent_id,
                'next_parent_category' => $next_parent_category,
                'user_categories' => \Auth::user()->categoriesIdsArray(),
            ]
        );
    }

    public function updateCategories(UpdateCategoriesRequest $request)
    {
        $parent_id = null;

        // Get parent id, or lack thereof
        if($request->has('parent_id'))
        {
            $parent_id = $request->get('parent_id');
        }

        // Delete current relationships for that parent category and user
        $category_ids = Categories::where('parent_id', $parent_id)->get()->pluck('id')->toArray();
        if(!is_null($category_ids))
        {
            UsersCategories::where('users_id', \Auth::user()->id)->whereIn('categories_id', $category_ids)->delete();
        }

        // Insert categories for user
        if($request->has('categories'))
        {
            if(is_array($request->get('categories')))
            {
                foreach($request->get('categories') as $category_id)
                {
                    $users_categories = new UsersCategories;
                    $users_categories->users_id = \Auth::user()->id;
                    $users_categories->categories_id = $category_id;
                    $users_categories->save();
                }
            }
            else
            {
                $users_categories = new UsersCategories;
                $users_categories->users_id = \Auth::user()->id;
                $users_categories->categories_id = $request->get('categories');
                $users_categories->save();
            }
        }

        if($request->has('next-parent-category'))
        {
            return redirect()->route('account.subcategories', $request->get('next-parent-category'));
        }

        return redirect()->route('root');
    }

    /** PRIVATE FUNCTIONS */

    /**
     * Return null if no parent categories left, otherwise return next parent category with subcategories
     * @return mixed
     */
    private function nextParentCategory($parent_categories, $index)
    {
        // Find the next parent category with sub categories
        for($i = $index; $i < count($parent_categories); $i++)
        {
            // If parent category has subcategories return parent category
            if($parent_categories[$i]->subCategoriesCount() > 0)
            {
                // if(in_array($parent_categories[$i]->id, \Auth::user()->categoriesIdsArray()))
                // {
                    return $parent_categories[$i];
                // }
            }
        }

        // If there are no more parent categories return null
        return null;
    }
}
