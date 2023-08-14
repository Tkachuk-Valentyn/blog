<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\PostRepositoryInterface;
use App\Services\Tasks\Contracts\TaskServiceInterface;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class TestController extends Controller
{


    /**
     * @param PostRepositoryInterface $postRepository
     * @param TaskServiceInterface $taskService
     */
    public function __construct(readonly PostRepositoryInterface $postRepository, readonly TaskServiceInterface $taskService)
    {

    }

    /**
     * @return JsonResponse
     */
    public function index()
    {

        $numbersStr = "1 2 3 4";
        $numbersStrArr = explode(' ', $numbersStr);
        $first = max($numbersStrArr);
        unset($numbersStrArr[array_search($first, $numbersStrArr)]);

        $second = max($numbersStrArr);


        return response()->json($first * $second);


    }

    /**
     * @return JsonResponse
     */
    public function unique()
    {

        $numbersStr = "0 2 3 1 2";
        $numbersStrArr = explode(' ', $numbersStr);
        $array = array_unique($numbersStrArr);
        return response()->json($array);
    }

    /**
     * @return JsonResponse
     */
    public function maxCount()
    {

        $numbersStr = "1 2 3 2 4 4 2 5";
        $numbersStrArr = explode(' ', $numbersStr);
        $maxNumber = [];

        $temp1 = $numbersStrArr[1];

        foreach ($numbersStrArr as $number) {
            if (array_key_exists($number, $maxNumber)) {
                $maxNumber[$number] = $maxNumber[$number] + 1;
            } else {
                $maxNumber[$number] = 1;
            }
        }
        $temp = max($maxNumber);

        foreach ($maxNumber as $number => $key) {
            if ($number == $temp) {
                return response()->json(array_search($number, $maxNumber));
            }
        }
        return response()->json(array_search($temp, $maxNumber));

    }

    /**
     * @return JsonResponse|void
     */

    public function anagrams()
    {
        $str = "night";
        $str1 = "thing";
        $arrStr = str_split($str);
        $arrStr1 = str_split($str1);
        $kVStr = [];
        $kVStr1 = [];

        foreach ($arrStr as $number) {
            if (array_key_exists($number, $kVStr)) {
                $kVStr[$number] = $kVStr[$number] + 1;
            } else {
                $kVStr[$number] = 1;
            }
        }
        foreach ($arrStr1 as $number) {
            if (array_key_exists($number, $kVStr1)) {
                $kVStr1[$number] = $kVStr1[$number] + 1;
            } else {
                $kVStr1[$number] = 1;
            }
        }

        if ($kVStr == $kVStr1) {
            return response()->json([$kVStr, $kVStr1]);
        }
    }

    /**
     * @return JsonResponse
     */

    public function luckyTicket()
    {
        $array = range(132401, 132601);
        $winTickets = [];
        foreach ($array as $number) {
            $digits = str_split($number);
            if (($digits[0] + $digits[1] + $digits[2]) == ($digits[3] + $digits[4] + $digits[5])) {
                $winTickets[$number] = 'win';
            }
        }
        return response()->json($winTickets);

    }

    /**
     * @param Request $request
     * @return array
     */
    public function filters(Request $request)
    {
        $orderby = $request->get('orderby');
        $posts = $request->get('post');

        if ($this->postRepository->isExistOrderBy($orderby)) {
            $this->postRepository->sortBy($orderby['field'], $orderby['direction'])->get();
        }
        if ($this->postRepository->isExistPost($posts)) {
            $this->postRepository->filter($posts)->get();
        }
        return $this->postRepository->get();
    }

    /**
     * @return JsonResponse|void
     */
    public function zodiac()
    {

        $zodiacs = [
            'vodoley' => ['2000-01-21', '2000-02-19'],
            'ribi' => ['2000-02-20', '2000-03-20'],
            'oven' => ['2000-03-21', '2000-04-20'],
            'telec' => ['2000-04-21', '2000-05-21'],
            'blizneci' => ['2000-05-22', '2000-06-21'],
            'rak' => ['2000-06-22', '2000-07-22'],
            'lion' => ['2000-07-23', '2000-08-21'],
            'deva' => ['2000-08-22', '2000-09-23'],
            'vesi' => ['2000-09-24', '2000-10-23'],
            'scorpion' => ['2000-10-24', '2000-11-22'],
            'strelec' => ['2000-11-23', '2000-12-22'],
            'kozerog' => ['2000-12-23', '2001-01-20']
        ];
        $time = Carbon::parse('2000-10-24');
        foreach ($zodiacs as $zodiacname => $range) {
            if ($time->between($range[0], $range[1])) {
                return response()->json($zodiacname);
            }
        }

    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function SumInSequence(Request $request): JsonResponse
    {
        $numbers = $request->get('numbers');
        return response()->json($this->taskService->maxSumInSequence($numbers));
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function bigNum(Request $request): JsonResponse
    {
        $numbers = $request->get('numbers');
        return response()->json($this->taskService->concatenationAndSortNums($numbers));
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function clockAngle(Request $request): JsonResponse
    {
        $hour = $request->get('hour');
        $minutes = $request->get('minutes');
        return response()->json($this->taskService->getSmallAngle($hour, $minutes));

    }

}
