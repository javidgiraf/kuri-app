<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\GoldRate;

class GoldRateController extends Controller
{
    public function index()
    {
        $goldRates = GoldRate::select('per_gram', 'per_pavan', 'date_on', 'status')->latest()->first();

        return response()->json([
            "success" => true,
            "data" => $goldRates,
            "message" => "Gold Rates Retrieved Successfully"
        ]);
    }
}
