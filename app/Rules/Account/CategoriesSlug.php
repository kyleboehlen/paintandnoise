<?php

namespace App\Rules\Account;

use Illuminate\Contracts\Validation\Rule;

// Models
use App\Models\Categories\Categories;

class CategoriesSlug implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Check both that the values are valid categories and all of the same parent category.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        // Iterate if value is an array of Cateogry slugs to add
        if(is_array($value))
        {
            $parent_id = null; // For validating sub categories are all of the same parent
            $first = true; // First loop flag

            foreach($value as $category_slug)
            {
                // Convert slug to an id
                $category_id = array_search($category_slug, config('categories.slugs'));
                if($category_id === false)
                {
                    return false; // Slug was not a valid slug
                }

                // Get a validated category including checking parent id
                if($first)
                {
                    $category = self::validatedCategoryById($category_id);
                    $first = false; // Flip flag
                }
                else
                {
                    $category = self::validatedCategoryById($category_id, $parent_id);
                }

                // Check if validation failed
                if($category === false)
                {
                    return false; // Return validation failed
                }

                // Set parent id
                $parent_id = $category->parent_id;
            }   
        }
        else
        {
            $category = self::validatedCategoryById($value); // Get a validated category

            // Check if validation failed
            if($category === false)
            {
                return false; // Return validation failed
            }
        }

        return true; // Return true if none of the validation calls come back false
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Invalid Category IDs.';
    }

    /**
     * Validate Category ID
     *
     * @param int $category_id
     * paremt_id expects an int or null
     * @param mixed $parent_id
     * Return App\Categories\Categories model if validated, otherwise return false
     * @return mixed
     */
    private static function validatedCategoryById($category_id, $parent_id = false)
    {
        // Hydrate model from id
        $category = Categories::find($category_id);

        // Validate category isn't null
        if(is_null($category))
        {
            return false; // Validation failed
        }

        // Validate parent category
        if($parent_id !== false) // Check if parent category was passed
        {
            if($category->parent_id != $parent_id) // Validate categories are of the same parent category
            {
                return false; // Validation failed
            }
        }

        return $category; // Return validated Category model
    }
}
