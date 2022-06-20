<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CustomerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $uniqueEmail = Rule::unique('users', 'email');
        if ($this->route()->hasParameter('customer')) {
            $uniqueEmail->ignore($this->route()->parameter('customer'));
        }

        return [
            'name'    => ['required', 'string'],
            'phone'   => ['required', 'string'],
            'email'   => ['required', 'email', $uniqueEmail],
            'address' => ['nullable', 'string']
        ];
    }
}
