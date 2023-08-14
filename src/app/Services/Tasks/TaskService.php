<?php

namespace App\Services\Tasks;

use App\Services\Tasks\Contracts\TaskServiceInterface;

class TaskService implements TaskServiceInterface
{
    private const DEGREES_IN_CIRCLE = 360;
    private const DEGREES_IN_HOUR= 30;
    private const DEGREES_IN_MINUTE = 6;
    private const HALF_DEGREES_IN_CIRCLE = 180;

    /**
     * @param string $numbers
     * @return int
     */
    public function maxSumInSequence(string $numbers): int
    {
        $numbersStrArr = explode(' ', $numbers);
        $numbersStrArr = array_map('intval', $numbersStrArr);
        $sum = 0;
        $log = array();
        for ($i = 0; $i < count($numbersStrArr); $i++) {
            if ($sum < 0) {
                $sum = 0;
            }
            $sum = $sum + $numbersStrArr[$i];
            array_push($log, $sum);
        }
        return max($log);
    }

    /**
     * @param string $numbers
     * @return string
     */
    public function concatenationAndSortNums(string $numbers): string
    {
        return $this->concatenationNums($numbers);
    }

    /**
     * @param string $nums
     * @return array
     */
    public function sortBufferNums(string $nums): array
    {
        $numbers = explode(' ', $nums);
        rsort($numbers, SORT_STRING);
        $buffer = [];
        foreach ($numbers as $num) {
            $firstSignOfNum = substr($num, 0, 1);
            if ($firstSignOfNum == $num) {
                if (!array_key_exists($firstSignOfNum, $buffer)) {
                    $buffer[$firstSignOfNum] = [];
                }
                array_unshift($buffer[$firstSignOfNum], $num);
            } else {
                $buffer[$firstSignOfNum][] = $num;
            }
        }
        return $buffer;
    }

    /**
     * @param string $numbers
     * @return string
     */
    public function concatenationNums(string $numbers): string
    {
        $concatenatedNums = '';
        foreach ($this->sortBufferNums($numbers) as $key => $nums) {
            for ($i = 0; $i < count($nums); $i++) {
                $concatenatedNums = $this->concatenation($concatenatedNums, $nums[$i]);
            }
        }
        return $concatenatedNums;
    }

    /**
     * @param string $concatenatedValue
     * @param string $value
     * @return string
     */
    public function concatenation(string $concatenatedValue, string $value): string
    {
        return $concatenatedValue . $value;

    }

    /**
     * @param int $hour
     * @param int $minutes
     * @return int
     */
    public function getSmallAngle(int $hour, int $minutes): int
    {
        $angle = $this->getAngle($hour, $minutes);

        if ($angle > self::HALF_DEGREES_IN_CIRCLE) {
            $angle = self::DEGREES_IN_CIRCLE - $angle;
        }

        return $angle;
    }

    /**
     * @param int $hour
     * @param int $minutes
     * @return int
     */
    private function getAngle(int $hour, int $minutes): int
    {
        $hour = $hour * self::DEGREES_IN_HOUR;
        $minutes = $minutes * self::DEGREES_IN_MINUTE;
        return abs(abs($hour - $minutes) - self::DEGREES_IN_CIRCLE);
    }
}
