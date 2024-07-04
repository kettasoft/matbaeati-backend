<?php

namespace Modules\Accounts\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['nullable', 'email', 'unique:users,email,' . auth()->id()],
            'phone' => ['required', 'unique:users,phone,' . auth()->id()],
            //            'old_password' => ['required_with:password', new PasswordRule(auth()->user()->password ?? 'password')],
            //            'password' => ['nullable', 'min:8', 'confirmed'],
            'avatar' => ['nullable', 'base64_image'],
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }
}
