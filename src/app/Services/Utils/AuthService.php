<?php

namespace App\Services\Utils;

use App\Services\Utils\Contracts\AuthServiceInterface;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Auth;

class AuthService implements AuthServiceInterface
{
    /**
     * @param string $email
     * @param string $password
     * @return bool
     */
    public function attempt(string $email, string $password): bool
    {
        return Auth::attempt(['email' => $email, 'password' => $password]);
    }

    /**
     * @return Authenticatable|null
     */
    public function user(): Authenticatable|null
    {
        return Auth::user();
    }
}
