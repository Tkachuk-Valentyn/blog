<?php

namespace App\Services\Utils\Contracts;

interface StrServiceInterface
{
    public function slug(string $header, string $separator = '-'): string;
}
