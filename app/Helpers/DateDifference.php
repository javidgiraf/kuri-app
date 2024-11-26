<?php

namespace App\Helpers;

use Carbon\Carbon;

class DateDifference
{
  public static function dateDifference($enddate): string
  {
    $now = Carbon::now();
    $date = Carbon::parse($enddate);
    $diff = $now->diff($date);
    $hasMinutes = $diff->i > 0;
    $hasSeconds = $diff->s > 0;
    $hasHours = $diff->h > 0;
    $hasWeeks = floor($diff->days / 7) > 0;
    $hasMonths = $diff->m > 0;
    $hasYears = $diff->y > 0;
    //return $hasMinutes? $diff->i.'minutes ago' : ($hasHours? $diff->h.'hours ago' : ($hasWeek  

    if ($hasYears) {
      $differnce =  ($hasYears === 1) ? $diff->y . ' year' : $diff->y . ' years';
    } else if ($hasMonths) {
      $differnce =  ($hasMonths === 1) ? $diff->m . ' week' : $diff->m . ' weeks';
    } else if ($hasWeeks) {
      $differnce =  ($hasWeeks === 1) ? $diff->days . ' week' : $diff->days . ' weeks';
    } else if ($hasHours) {
      $differnce =  ($hasHours === 1) ? $diff->h . ' hour' : $diff->h . ' hours';
    } else if ($hasMinutes) {
      $differnce =  ($hasMinutes === 1) ? $diff->i . ' minute' : $diff->i . ' minutes';
    } else {
      $differnce = ($hasSeconds === 1) ? $diff->s . ' second' : $diff->s . ' seconds';
    }

    return $differnce;
  }
}
