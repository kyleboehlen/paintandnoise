<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Log;
use Image;
use Storage;

// Requests
use App\Http\Requests\Account\ShowCategoriesRequest;
use App\Http\Requests\Account\UpdateCategoriesRequest;
use App\Http\Requests\Account\UpdateNameRequest;
use App\Http\Requests\Account\UpdateProfilePictureRequest;

// Rules
use App\Rules\Account\ParentCategoriesSlug;

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

        // Hydrate user model
        $user = \Auth::user();

        return view('account.index')->with([
            'show' => $show,
            'user' => $user,
        ]);
    }

    public function showCategories($parent_slug = false)
    {
        $parent_id = null;

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

        // Parent categories returned if parent slug isn't set
        if($parent_slug === false)
        {
            $categories = $parent_categories;
            $index = -1;
        }
        else
        {
            // Validate parent slug
            $validator = Validator::make(['parent-slug' => $parent_slug], [
                'parent-slug' => ['required', new ParentCategoriesSlug]
            ]);
            
            if($validator->fails())
            {
                return redirect()->route('account.categories')->withErrors($validator);
            }

            $parent_id = array_search($parent_slug, config('categories.slugs'));

            // Search for the index of the parent category with an id matching param
            if(($index = $parent_categories->search(function($category) use ($parent_id){
                    return $category->id == $parent_id;
            })) !== false)
            {
                // Get parent id subcategories
                $categories = $parent_categories[$index]->subCategories;

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
        if(!is_null($parent_id) && !in_array($parent_id, $users_categories))
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
                'parent_slug' => $parent_slug,
                'next_parent_category' => $next_parent_category,
                'user_categories' => \Auth::user()->categoriesIdsArray(),
            ]
        );
    }

    public function updateCategories(UpdateCategoriesRequest $request)
    {
        $parent_id = null;

        // Get parent slug, or lack thereof
        if($request->has('parent-slug'))
        {
            $parent_id = array_search($request->get('parent-slug'), config('categories.slugs'));
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
            if(is_array($request->get('categories'))) // Iterate through array if several IDs have been provided
            {
                foreach($request->get('categories') as $category_slug)
                {
                    $category_id = array_search($category_slug, config('categories.slugs'));
                    $users_categories = new UsersCategories;
                    $users_categories->users_id = \Auth::user()->id;
                    $users_categories->categories_id = $category_id;
                    if(!$users_categories->save())
                    {
                        Log::warning('Failed to update categories for user.', [
                            'user_id' => \Auth::user()->id,
                            'category_id' => $category_id,
                        ]);
                    }
                    else
                    {
                        Log::info('Added category for user.', [
                            'user_id' => \Auth::user()->id,
                            'category_id' => $category_id,
                        ]);
                    }
                }
            }
            else // Single ID
            {
                $users_categories = new UsersCategories;
                $users_categories->users_id = \Auth::user()->id;
                $users_categories->categories_id = array_search($request->get('categories'), config('categories.slugs'));
                if(!$users_categories->save())
                {
                    Log::warning('Failed to update categories for user.', [
                        'user_id' => \Auth::user()->id,
                        'category_id' => $category_id,
                    ]);
                }
                else
                {
                    Log::info('Added category for user.', [
                        'user_id' => \Auth::user()->id,
                        'category_id' => $category_id,
                    ]);
                }
            }
        }

        if($request->has('next-parent-category'))
        {
            return redirect()->route('account.subcategories', $request->get('next-parent-category'));
        }

        return redirect()->route('account');
    }

    public function updateName(UpdateNameRequest $request)
    {
        // Get user
        $user = \Auth::user();

        // Set new name
        $user->name = $request->get('name');
        if(!$user->save())
        {
            Log::warning('Failed to update categories for user.', [
                'user_id' => $user->id,
                'name', $request->get('name'),
            ]);
        }
        else
        {
            Log::info('User updated name', [
                'user_id' => $user->id,
                'name', $request->get('name'),
            ]);
        }

        // Redirect back to account
        return redirect()->route('account');
    }

    public function updateProfilePicture(UpdateProfilePictureRequest $request)
    {
        // Get user
        $user = \Auth::user();
        
        // Set storage path
        $path = config('media.path') . config('profilepictures.sub_dir');

        // Save image
        try
        {
            $storage = Storage::putFile($path, $request->file('profile-picture'));
            $user->profile_picture = substr($storage, strrpos($storage, '/') + 1);
            $img = Image::make($path . $user->profile_picture)->fit(600, 600)->save();
        }
        catch(\Exception $e)
        {
            Log::info('User attempted to upload too large of a profile picture.', [
                'user_id' => $user->id
            ]);

            return redirect()->back()->withErrors([
                'profile-picture' => 'File Too Large :('
            ]);
        }
        
        if(!$user->save())
        {
            Log::warning('User failed to save with new profile picture name.', [
                'user_id' => $user->id,
                'profile_picture' => $user->profile_picture,
            ]);
        }
        else
        {
            Log::info('User updated profile picture.', [
                'user_id' => $user->id,
            ]);
        }

        return redirect()->route('account');
    }

    public function updateNSFW()
    {
        // Get user
        $user = \Auth::user();

        // Toggle NSFW Setting
        $user->toggleNSFW();
        if(!$user->save())
        {
            Log::warning('Failed to save user NSFW settings.', [
                'user_id' => $user->id,
            ]);
        }
        else
        {
            Log::info('User updated NSFW settings.', [
                'user_id' => $user->id,
            ]);
        }

        return redirect()->route('account');
    }

    public function updatePassword()
    {
        // Get user
        $user = \Auth::user();

        // Send password notification
        $user->sendPasswordResetNotification($user->newResetPasswordToken());

        // Log token event
        Log::info('Manually generated password reset token and notifcation for user.', [
            'user_id' => $user->id,
            'sent_to' => $user->email,
        ]);

        // Return redirect with the success status alert
        return redirect()->route('account')->with('status', 'We have e-mailed your password reset link!');
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
