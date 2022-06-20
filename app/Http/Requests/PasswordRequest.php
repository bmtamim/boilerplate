<?php

namespace App\Http\Requests;

use App\Actions\Fortify\PasswordValidationRules;
use Illuminate\Foundation\Http\FormRequest;

class PasswordRequest extends FormRequest
{
    use PasswordValidationRules;

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
        return [
            'current_password' => ['required', 'string', 'current_password:web'],
            'new_password'     => $this->passwordRules(),
            'confirm_password' => ['required', 'string', 'same:new_password'],
        ];
    }

    public function messages()
    {
        return [
            'confirm_password.same' => 'New Password and Confirm Password doesn\'t matched.',
        ];
    }
}
