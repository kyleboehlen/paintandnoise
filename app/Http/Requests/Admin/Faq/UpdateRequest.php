<?php

namespace App\Http\Requests\Admin\Faq;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

// Models
use App\Models\Faqs;

// Permissions
use App\Http\Helpers\Constants\Admin\Permissions;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return \Auth::guard('admin')->user()->checkPermissions(Permissions::MANAGE_FAQS);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'faq-id' => ['required', Rule::in(Faqs::all()->pluck('id'))],
            'question' => 'required|max:65535',
            'answer' => 'required|max:65535',
        ];
    }
}
