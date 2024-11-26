<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Deposit extends Model
{
    use HasFactory;

    protected $fillable = [
        'subscription_id',
        'order_id',
        'user_type',
        'payment_type',
        'total_scheme_amount',
        'service_charge',
        'gst_charge',
        'final_amount',
        'paid_at',
        'remarks',
        'status',
    ];

    public function deposit_periods()
    {
        return $this->hasMany(DepositPeriod::class, 'deposit_id', 'id');
    }
    public function subscription()
    {
        return $this->hasOne(UserSubscription::class, 'id', 'subscription_id');
    }
}
