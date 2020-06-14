<?php

namespace App\Rules\Account;

use Illuminate\Contracts\Validation\Rule;

// Models
use App\Models\Categories\Categories;

class ParentCategoriesSlug implements Rule
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
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $slugs = config('categories.slugs');

        // Verify it is a valid slug
        if(in_array($value, $slugs))
        {
            // Hydrate category
            $category = Categories::find(array_search($value, $slugs));

            // Verify it is a parent category
            return is_null($category->parent_id);
        }

        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Invalid next-parent-slug.';
    }
}
