<?php

namespace App\Rules\Admin;

use Illuminate\Contracts\Validation\Rule;

// Models
use App\Models\Admin\AdminUsers;

class AdminUserId implements Rule
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
        if($value === 1)
        {
            return false; // No changing the super admin
        }

        $admin_user = AdminUsers::find($value);

        return !is_null($admin_user);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Invalid Admin User ID.';
    }
}
