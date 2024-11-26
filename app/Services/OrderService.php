<?php

namespace App\Services;

use App\Models\User;
use App\Models\Customer;
use App\Models\Address;
use App\Models\Nominee;
use App\Models\Scheme;
use App\Models\UserSubscription;
use App\Models\Deposit;
use App\Models\DepositPeriod;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Hash;
use File;

use App\Helpers\MachineHelper;
use App\Helpers\UniqueHelper;
use App\Models\Discontinue;
use App\Models\TransactionDetail;

class OrderService
{


    public function getSuccessDepositByOrder($order_id): Object
    {
        $successDepositByOrder =
            deposit::with(['depositPeriod' => function ($query) {
                $query->where('status', 1);
            }])
            ->first();
        return $successDepositByOrder;
    }


    public function saveFailedProcessStatus(array $userData): ?string
    {

        $update = [
            'status'    => $userData['failed_process_status'],
        ];
        Deposit::where('id', $userData['deposit_id'])->update($update);
        $deposit_period = DepositPeriod::where('deposit_id', $userData['deposit_id'])->get();
        foreach ($deposit_period as $item) {
            $item->update([
                'status' => $userData['failed_process_status'],
            ]);
        }
        return '1';
    }
}
