<?php

namespace App\Services;

use App\Models\User;
use App\Models\Customer;
use App\Models\LogActivity;

use Illuminate\Http\Request;



class LogActivityService
{

    public function getlogActivities(): Object
    {
        $logactivities = LogActivity::orderBy('id', 'desc')->paginate(10);

        return  $logactivities;
    }
    // public function createUser(array $userData): User
    // {
    //     $user = User::create([
    //         'name'     => $userData['name'],
    //         'email'    => $userData['email'],
    //         'password' => $userData['password'],
    //     ]);
    //     $user->assignRole('customer');
    //     Customer::create([
    //         'user_id'   => $user->id,
    //         'mobile'     => $userData['mobile'],
    //         'password' => $userData['password'],
    //         'referrel_code'     => $userData['referrel_code'],
    //         'status'     => $userData['status'],

    //     ]);
    //     return $user;
    // }

    public function getLogActivity($id): Object
    {
        return LogActivity::find($id);
    }


    // public function updateUser(User $user, array $userData, string $imageUrl = null): void
    // {

    //     $update = [
    //         'name'    => $userData['name'],
    //         'email'    => $userData['email'],
    //         'password'    => $userData['password'],

    //     ];
    //     $user->update($update);
    //     Customer::where('user_id', $user->id)->update([
    //         'referrel_code' => $userData['referrel_code'],
    //         'mobile' => $userData['mobile'],
    //         'password' =>  $userData['password'],
    //         'aadhar_number' => $userData['aadhar_number'],
    //     ]);
    //     Address::updateOrCreate(
    //         [
    //             //Add unique field combo to match here
    //             //For example, perhaps you only want one entry per user:
    //             'user_id'   => $user->id,
    //         ],
    //         [
    //             'address'     => $userData['address'],
    //             'country_id' =>  $userData['country_id'],
    //             'state_id'    => $userData['state_id'],
    //             'district_id'   => $userData['district_id'],
    //             'pincode'       => $userData['pincode'],
    //         ]
    //     );
    //     Nominee::updateOrCreate(
    //         [
    //             //Add unique field combo to match here
    //             //For example, perhaps you only want one entry per user:
    //             'user_id'   => $user->id,
    //         ],
    //         [
    //             'name'     => $userData['nominee_name'],
    //             'relationship' => $userData['nominee_relationship'],
    //             'phone'    => $userData['nominee_phone'],
    //         ]
    //     );
    // }

    // public function deleteUser(User $user): void
    // {
    //     // delete country
    //     User::find($user->id)->delete();
    //     Customer::where('user_id', $user->id)->delete();
    // }
    // function generateDates($start_date_str, $end_date_str)
    // {
    //     $start_date = Carbon::parse($start_date_str);
    //     $end_date = Carbon::parse($end_date_str);

    //     $current_date = $start_date;
    //     $dates_list = [];

    //     while ($current_date <= $end_date) {
    //         $dates_list[] = $current_date->format('d-m-Y');
    //         // Stop when the current month is reached
    //         if ($current_date->format('m-Y') == now()->format('m-Y')) {
    //             break;
    //         }

    //         $current_date->addMonth(); // Increment by one month
    //     }

    //     return $dates_list;
    // }


    // public function getCurrentPlanHistory($user_subscription_id, $user_id, $scheme_id)
    // {
    //     $user_subscription = UserSubscription::with('scheme')->where('user_id', $user_id)->where('scheme_id', $scheme_id)->first();
    //     $user_subscription_deposits =  Deposit::where('subscription_id', $user_subscription_id)->get();


    //     $start_date_str = $user_subscription->start_date;
    //     $end_date_str = $user_subscription->end_date;
    //     $result_dates = $this->generateDates($start_date_str, $end_date_str);
    //     $rs_dates = [];
    //     foreach ($result_dates as &$d) {
    //         $rs_dates[] = [
    //             'date' => $d,
    //             'amount' => $user_subscription->scheme->schedule_amount,
    //             'is_due' => 0,
    //             'status' => '0',

    //         ];
    //     }
    //     if ($user_subscription_deposits != "") {
    //         $deposit_periods = [];
    //         $sum = 0;
    //         foreach ($user_subscription_deposits as $dp) {
    //             $deposit_periods[] = $dp->deposit_periods
    //                 ->where('status', 1)
    //                 ->toarray();
    //             if ($dp->status == 1) {
    //                 $sum += $dp->final_amount;
    //             }
    //         }
    //         $balance_amount = $user_subscription->scheme->total_amount - $sum;
    //         $deposit_periods2 = [];
    //         foreach ($user_subscription_deposits as $dp) {
    //             $deposit_periods2[] = $dp->deposit_periods
    //                 ->where('status', 2)
    //                 ->toarray();
    //         }



    //         $deposit_dues = [];
    //         foreach ($user_subscription_deposits as $dp) {
    //             $deposit_dues[] = $dp->deposit_periods
    //                 ->where('is_due', 1)
    //                 ->toarray();
    //         }



    //         $flattenedArray = array_merge_recursive(...$deposit_periods);
    //         $flattenedArray2 = array_merge_recursive(...$deposit_periods2);
    //         $flattenedduesArray = array_merge_recursive(...$deposit_dues);

    //         $items = [];
    //         foreach ($flattenedArray as &$item) {
    //             // Keep only 'due_date' and 'status'

    //             $items[] = [

    //                 'due_date' =>
    //                 Carbon::parse($item['due_date'])->format('d-m-Y'),
    //                 'is_due' => $item['is_due'],
    //                 'status' => $item['status'],
    //             ];
    //         }

    //         $items3 = [];
    //         foreach ($flattenedArray2 as &$item) {
    //             // Keep only 'due_date' and 'status'

    //             $items3[] = [

    //                 'due_date' =>
    //                 Carbon::parse($item['due_date'])->format('d-m-Y'),
    //                 'is_due' => $item['is_due'],
    //                 'status' => $item['status'],
    //             ];
    //         }

    //         $dues = [];
    //         foreach ($flattenedduesArray as &$due) {
    //             // Keep only 'due_date' and 'status'

    //             $dues[] = [

    //                 'due_date' =>
    //                 Carbon::parse($due['due_date'])->format('d-m-Y'),
    //                 'is_due' => $due['is_due'],
    //                 'status' => $due['status'],
    //             ];
    //         }



    //         foreach ($rs_dates as &$item1) {
    //             // Set initial status to 0
    //             $item1['status'] = 0;
    //             $item1['is_due'] = 0;

    //             foreach ($items as $item2) {
    //                 // Compare based on some criteria, for example, 'id'
    //                 if ($item1['date'] === $item2['due_date']) {
    //                     // If data exists, set status to 1
    //                     if ($item2['status'] === 1) {
    //                         $item1['status'] = 1;
    //                     }



    //                     break; // No need to check further
    //                 }
    //             }
    //             foreach ($items3 as $item2) {
    //                 // Compare based on some criteria, for example, 'id'
    //                 if ($item1['date'] === $item2['due_date']) {
    //                     // If data exists, set status to 1

    //                     if ($item2['status'] === 2) {
    //                         $item1['status'] = 2;
    //                     }



    //                     break; // No need to check further
    //                 }
    //             }
    //             foreach ($dues as $item2) {
    //                 // Compare based on some criteria, for example, 'id'
    //                 if ($item1['date'] === $item2['due_date']) {
    //                     // If data exists, set status to 1
    //                     if ($item2['is_due'] === 1) {
    //                         $item1['is_due'] = 1;
    //                     }



    //                     break; // No need to check further
    //                 }
    //             }
    //         }
    //     }
    //     return  $responseData = [
    //         'user_subscription' => $user_subscription,
    //         'user' => $user_subscription->user,
    //         'scheme' => $user_subscription->scheme,
    //         'scheme_start_date' => Carbon::parse($user_subscription->start_date)->format('d-m-Y'),
    //         'scheme_end_date' => Carbon::parse($user_subscription->end_date)->format('d-m-Y'),
    //         'total_amount_paid' => $sum,
    //         'balance_amount' => $balance_amount,
    //         'result_dates' => $rs_dates,
    //         'status' => '1'
    //     ];
    // }
}
