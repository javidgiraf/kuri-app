<?php

namespace App\Exports;

use App\Models\UserSubscription;
use Maatwebsite\Excel\Concerns\FromCollection;

class UserSubscriptionExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return UserSubscription::all();
    }
}
