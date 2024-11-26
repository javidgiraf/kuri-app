<?php

namespace App\Console\Commands;

use App\Models\SubscriptionHistory;
use App\Models\UserSubscription;
use Carbon\Carbon;
use Illuminate\Console\Command;

class CloseSchema extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'close:scheme';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '11 Months after hold Kuri Scheme';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->closeScheme();

        return true;
    }

    public function closeScheme()
    {
        $userSubscriptions = UserSubscription::with('scheme')->get();
        $userSubscriptions->map(function ($userSubscription) {
            $startDate = Carbon::parse($userSubscription->start_date);
            $endDate = Carbon::parse($userSubscription->end_date);

            if ($startDate->diffInMonths($endDate) > $userSubscription->scheme->total_period) {
                $userSubscription->update([
                    'is_closed' => true
                ]);

                SubscriptionHistory::updateOrCreate(
                    ['subscription_id' => $userSubscription->id],
                    [
                        'is_closed' => true,
                    ]
                );
            }
        });
    }
}
