<?php

// make a trait

namespace App\Traits;

use Carbon\Carbon;

trait getWeeksFromRange
{
    public function getWeeksFromRange(int $year, String $month, String $day, array $employeeWeksTimesheet, $startWeek = 'monday', $endWeek = 'sunday')
    {
        $rangeArray = [];
        $now = Carbon::now();
        $actualYear = $now->year;
        $cycles = ($actualYear - $year) + 1;
        $lastYear = $year;
        for ($i = 1; $i <= $cycles; $i++) {
            $firstDayOfYear = mktime(0, 0, 0, 1, 1, $year);
            $nextMonday = strtotime($startWeek, $firstDayOfYear);
            $nextFriday = strtotime($endWeek, $nextMonday);

            $startActualWeek = $now->startOfWeek(Carbon::MONDAY)->format('Y-m-d');
            $endActualWeek = $now->endOfWeek(Carbon::SUNDAY)->format('Y-m-d');
            $actualWeek = $startActualWeek . '-' . $endActualWeek;
            $currentWeek = '';
            while (date('Y', $nextMonday) == $year) {
                $mont_it = intval(date('m', $nextMonday));
                $day_it = intval(date('d', $nextMonday));
                if ($lastYear == $year) {
                    if (Carbon::parse($nextMonday)->gte(Carbon::parse($year . '-' . $month . '-' . $day))) {
                        $currentWeek = 'Del <strong>' . date('d/m/Y', $nextMonday) . '</strong> al <strong>' . date('d/m/Y', $nextFriday) . '</strong>';
                        $rangeArray[] = $currentWeek;
                        if ($actualWeek == $currentWeek) {
                            break;
                        }
                    }
                } else {
                    $currentWeek = 'Del <strong>' . date('d/m/Y', $nextMonday) . '</strong> al <strong>' . date('d/m/Y', $nextFriday) . '</strong>';
                    $rangeArray[] = $currentWeek;
                    if ($actualWeek == $currentWeek) {
                        break;
                    }
                }
                $nextMonday = strtotime('+1 week', $nextMonday);
                $nextFriday = strtotime('+1 week', $nextFriday);
            }
            $year++;
        }
        $diffArray = array_diff($rangeArray, $employeeWeksTimesheet);

        return $diffArray;
    }
}
