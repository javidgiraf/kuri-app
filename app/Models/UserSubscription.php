<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserSubscription extends Model
{
    use HasFactory, SoftDeletes;

    const STATUS_DEACTIVE = 0;
    const STATUS_ACTIVE = 1;
    const STATUS_DISCONTINUE = 2;
    const STATUS_ONHOLD = 3;

    protected $fillable = [
        'user_id',
        'name',
        'scheme_id',
        'start_date',
        'end_date',
        'is_closed',
        'status',
        'subscribe_amount'
    ];

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
    public function scheme()
    {
        return $this->hasOne(Scheme::class, 'id', 'scheme_id');
    }

    public function deposits()
    {
        return $this->hasMany(Deposit::class, 'subscription_id', 'id');
    }
}