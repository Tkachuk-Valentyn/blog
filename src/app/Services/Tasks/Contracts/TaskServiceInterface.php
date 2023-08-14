<?php

namespace App\Services\Tasks\Contracts;

interface TaskServiceInterface
{
    public function maxSumInSequence(string $numbers): int;

    public function concatenationAndSortNums(string $numbers): string;

    public function sortBufferNums(string $nums): array;

    public function concatenationNums(string $numbers): string;

    public function concatenation(string $concatenatedValue, string $value): string;

    public function getSmallAngle(int $hour, int $minutes): int;

}
