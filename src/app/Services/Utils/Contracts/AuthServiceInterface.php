<?php

namespace App\Services\Utils\Contracts;

interface AuthServiceInterface
{
    public function attempt(string $email, string $password): bool;
}
