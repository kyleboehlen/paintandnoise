<?php

namespace App\Http\Requests\Admin\Users;

use Illuminate\Foundation\Http\FormRequest;

// Permissions
use App\Http\Permissions\Admin;

// Rules
use App\Rules\Admin\AdminUserId;

class RedirectRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return \Auth::guard('admin')->user()->checkPermissions(Admin::VIEW_ADMINS);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'user-id' => ['required', 'numeric', new AdminUserId, ],
        ];
    }
}
