<?php

namespace App\Http\Requests;

use App\Actions\Fortify\PasswordValidationRules;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Rules\Password;

class UserRequest extends FormRequest
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
        $emailUnique          = Rule::unique('users', 'email');
        $phoneUnique          = Rule::unique('users', 'phone');
        $passwordRequiredRule = 'required';
        if ($this->route()->hasParameter('user')) {
            $emailUnique->ignore($this->route()->parameter('user'));
            $phoneUnique->ignore($this->route()->parameter('user'));
            $passwordRequiredRule = 'nullable';
        }

        return [
            'name'     => ['required', 'string'],
            'email'    => ['required', 'email', $emailUnique],
            'phone'    => ['required', 'string', $phoneUnique],
            'role'     => ['required', 'string'],
            'address'  => ['nullable', 'string'],
            'image'    => ['nullable', 'image'],
            'password' => [$passwordRequiredRule, 'string', new Password],
        ];
    }
}
