<?php

namespace App\Console\Commands;

use App\Models\GoldRate;
use App\Services\GoldService;
use Illuminate\Console\Command;

class UpdateGoldRate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:gold-rate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update 22K916 Gold Rate';

    /**
     * Execute the console command.
     */
    public function handle(GoldService $goldService, GoldRate $goldRate)
    {
        $goldService->updateGoldRate($goldRate->first(), $this->checkGoldRates());

        return true;
    }

    public function checkGoldRates()
    {
        $url = env("CHECK_GOLD_RATE_URL");

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);

        if ($response) {
            preg_match('/22K916 \(1gm\) - ₹ (\d+)/', $response, $matches);

            if (!empty($matches)) {
                $goldPrice = $matches[true];
                $goldPricePavan = $goldPrice * 8;

                return [
                    'per_gram' => $goldPrice,
                    'per_pavan' => $goldPricePavan,
                    'status' => true
                ];
            }
        }
    }
}
