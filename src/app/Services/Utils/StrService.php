<?php

namespace App\Services\Utils;

use App\Services\Utils\Contracts\StrServiceInterface;
use Illuminate\Support\Str;

class StrService implements StrServiceInterface
{



    /**
     * @param string $header
     * @param string $separator
     * @return string
     */
        public function slug(string $header, string $separator = '-'): string
        {
        return Str::slug($header, $separator);
    }
}
