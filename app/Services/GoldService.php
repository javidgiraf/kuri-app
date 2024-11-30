<?php

namespace App\Services;

use App\Models\GoldRate;
use Illuminate\Http\Request;
use Carbon\Carbon;


class GoldService
{

    public function getGoldRates($from_date = NULL, $to_date = NULL): Object
    {

        return Goldrate::where('date_on', '>=', $from_date)
                    ->where('date_on', '<=', $to_date)
                    ->latest()
                    ->paginate(10);
    }

    /**
     * Retrieve the gold rate by its ID.
     *
     * @param datatype $id description
     * @return Object
     */
    public function getGoldRate($id): Object
    {

        return GoldRate::find($id);
    }

    public function updateGoldRate(GoldRate $goldRate, array $userData): void
    {


        $update = [
            'per_gram'    => $userData['per_gram'],
            'per_pavan'    => $userData['per_pavan'],
            'date_on'    => Carbon::now()->format('Y-m-d H:i:s'),
            'status'    => $userData['status'],

        ];
        //  date('d-m-Y', strtotime($goldRate->date_on)) == date('d-m-Y', strtotime(Carbon::now())) ? $goldRate->update($update) : GoldRate::create($update);

        Carbon::parse($goldRate->date_on)->format('d-m-Y') == Carbon::now()->format('d-m-Y') ? $goldRate->update($update) : GoldRate::create($update);
    }
}
