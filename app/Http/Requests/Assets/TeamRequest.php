<?php

namespace App\Http\Requests\Assets;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Validator;

class TeamRequest extends FormRequest
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
            'name' => $this->route('name')
        ];

        // Get names of team members
        $names = array_column(config('team.members'), 'name');

        // Set validator rules
        $rules = ['name' => ['required', 'alpha', Rule::in($names)]];

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
