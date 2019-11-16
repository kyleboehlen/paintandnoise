<?php

namespace App\Http\Requests\Assets;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Validator;

class IconRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // Set validator input
        $input = [
            'identifier' => $this->route('identifier')
        ];

        // Set validator rules
        $rules = ['identifier' => ['required', 'alpha', Rule::in([
            // Icon identifiers (this may need to move to a perm:: like class)
            'instagram',
            'facebook',
            'twitter',
        ])]];

        // Return true if validator passes
        return Validator::make($input, $rules)->passes();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            // Validated in authorize()
        ];
    }
}
