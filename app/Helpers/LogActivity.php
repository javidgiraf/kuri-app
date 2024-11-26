<?php


namespace App\Helpers;

use Request;
use App\Models\LogActivity as LogActivityModel;


class LogActivity
{


  public static function addToLog($subject)
  {
    $log = [];
    $log['subject'] = $subject;
    $log['url'] = request()->fullUrl();
    $log['method'] = request()->method();
    $log['ip'] = request()->ip();
    $log['agent'] = request()->header('user-agent');
    $log['user_id'] = auth()->check() ? auth()->user()->id : 47;
    LogActivityModel::create($log);
  }


  public static function logActivityLists()
  {
    return LogActivityModel::latest()->get();
  }
}
