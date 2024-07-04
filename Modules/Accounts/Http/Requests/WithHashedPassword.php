<?php

declare(strict_types=1);

namespace Modules\Accounts\Http\Requests;

use Illuminate\Support\Facades\Hash;

trait WithHashedPassword
{
    /**
     * Get all of the input and files for the request and hash password if exists.
     *
     * @return array
     */
    public function validatedWithHashedPassword(array|int|string|null $key = null, mixed $default = null)
    {
        if ($password = $this->input('password')) {
            return array_merge(
                $this->validated($key),
                [
                    'password' => Hash::make($password),
                    'preferred_locale' => $this->input('preferred_locale') ?? app()->getLocale(),
                ]
            );
        }

        return $this->except('password');
    }
}
