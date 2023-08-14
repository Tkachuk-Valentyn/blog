<?php

namespace App\Services\Contracts;

interface IPostServiceInterface
{
    public function createSlug(string $header): string;
}
