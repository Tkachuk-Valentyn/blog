<?php

namespace App\Services;

use App\Services\Contracts\IPostServiceInterface;
use App\Services\Utils\Contracts\StrServiceInterface;

class PostService implements IPostServiceInterface
{

    public function __construct(readonly StrServiceInterface $strService)
    {

    }

    /**
     * @param string $header
     * @return string
     */
    public function createSlug(string $header): string
    {
        return $this->strService->slug($header);
    }
}
