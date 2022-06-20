<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class ProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return checkPermission('profile_settings');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name'    => ['required', 'string'],
            'email'   => ['required', 'email', Rule::unique('users', 'email')->ignore(Auth::id())],
            'phone'   => ['required', 'numeric', Rule::unique('users', 'phone')->ignore(Auth::id())],
            'address' => ['nullable', 'string'],
            'image'   => ['nullable', 'image'],
        ];
    }
}
