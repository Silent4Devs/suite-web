<?php

// make a trait

namespace App\Traits;

use Carbon\Carbon;

trait getWeeksFromRange
{
    public function getWeeksFromRange(int $year, string $month, string $day, array $employeeWeksTimesheet, $startWeek, $endWeek, $fecha_fin, $fecha_fin_extern, $faltantes = null)
    {
        $rangeArray = [];
        $now = Carbon::now();
        $actualYear = $now->year;
        if ($faltantes) {
            $cycles = $fecha_fin_extern->year - $year;
        } else {
            $cycles = ($fecha_fin_extern->year - $year) + 1;
        }
        $lastYear = $year;
        if ($fecha_fin != null) {
            $endActualWeek = $fecha_fin->endOfWeek(Carbon::SUNDAY)->format('Y-m-d');
            $startActualWeek = $fecha_fin->startOfWeek(Carbon::MONDAY)->format('Y-m-d');
            $actualWeek = $startActualWeek.'|'.$endActualWeek;
        } else {
            $startActualWeek = $fecha_fin_extern->startOfWeek(Carbon::MONDAY)->subDays(7)->format('Y-m-d');
            $endActualWeek = $fecha_fin_extern->endOfWeek(Carbon::SUNDAY)->format('Y-m-d');
            $actualWeek = $startActualWeek.'|'.$endActualWeek;
        }
        for ($i = 1; $i <= $cycles; $i++) {
            $firstDayOfYear = mktime(0, 0, 0, 1, 1, $year);
            $nextMonday = strtotime($startWeek, $firstDayOfYear);
            $nextFriday = strtotime($endWeek, $nextMonday);

            $currentWeek = '';
            while (date('Y', $nextMonday) == $year) {
                $mont_it = intval(date('m', $nextMonday));
                $day_it = intval(date('d', $nextMonday));
                if ($lastYear == $year) {
                    if (Carbon::parse($nextMonday)->gte(Carbon::parse($year.'-'.$month.'-'.$day))) {
                        $currentWeek = date('Y-m-d', $nextMonday).'|'.date('Y-m-d', $nextFriday);
                        $rangeArray[] = $currentWeek;
                        if ($actualWeek == $currentWeek) {
                            break;
                        }
                    }
                } else {
                    $currentWeek = date('Y-m-d', $nextMonday).'|'.date('Y-m-d', $nextFriday);
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
