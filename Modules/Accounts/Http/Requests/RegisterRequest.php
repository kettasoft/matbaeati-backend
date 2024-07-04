<?php

namespace Modules\Accounts\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;
use Modules\Accounts\Http\Requests\WithHashedPassword;

class RegisterRequest extends FormRequest
{
    use WithHashedPassword;
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'min:3'],
            'email' => ['required', 'string', 'email'],
            'phone' => ['required', 'string'],
            'password' => ['required', 'string', Password::defaults(), 'confirmed'],
            'type' => ['nullable'],
            'preferred_locale' => ['nullable'],
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
