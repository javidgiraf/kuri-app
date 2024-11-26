<?php

namespace App\Console\Commands;

use App\Models\SubscriptionHistory;
use App\Models\UserSubscription;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class HoldSchema extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'hold:scheme';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '10 Days after hold Kuri Scheme';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->holdScheme();

        return true;
    }

    function holdScheme()
    {
        try {
            $userSubscriptions = UserSubscription::with('scheme')->get();
            $userSubscriptions->map(function ($userSubscription) {
                $subscriptionStart = Carbon::parse($userSubscription->start_date);
                $subscriptionEnd = Carbon::parse($userSubscription->end_date);
        
                $currentMonthStart = $subscriptionStart->copy()->startOfMonth();
                $currentMonthEnd = $currentMonthStart->copy()->addDays(10);
        
                $nextMonthStart = $subscriptionStart->copy()->addMonth()->startOfMonth();
                $nextMonthEnd = $nextMonthStart->copy()->addDays(10);
        
                $lastMonthStart = $subscriptionEnd->copy()->subMonth()->startOfMonth();
                $lastMonthEnd = $lastMonthStart->copy()->addDays(10);
        
                if ($subscriptionStart->between($currentMonthStart, $currentMonthEnd)) {
                    $userSubscription->update(['status' => UserSubscription::STATUS_ONHOLD]);
        
                    SubscriptionHistory::updateOrCreate(
                        ['subscription_id' => $userSubscription->id],
                        [
                            'status' => UserSubscription::STATUS_ONHOLD,
                            'is_closed' => false
                        ]
                    );
                }
        
                if ($subscriptionStart->between($nextMonthStart, $nextMonthEnd)) {
                    $userSubscription->update(['status' => UserSubscription::STATUS_ONHOLD]);
        
                    SubscriptionHistory::updateOrCreate(
                        ['subscription_id' => $userSubscription->id],
                        [
                            'status' => UserSubscription::STATUS_ONHOLD,
                            'is_closed' => false
                        ]
                    );
                }
        
                if ($subscriptionStart->between($lastMonthStart, $lastMonthEnd)) {
                    $userSubscription->update(['status' => UserSubscription::STATUS_ONHOLD]);
        
                    SubscriptionHistory::updateOrCreate(
                        ['subscription_id' => $userSubscription->id],
                        [
                            'status' => UserSubscription::STATUS_ONHOLD,
                            'is_closed' => false
                        ]
                    );
                }
            });
        } catch (\Exception $e) {
            Log::error('Error in Hold Scheme: ' . $e->getMessage());
        }
    }
}
