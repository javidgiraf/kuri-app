<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Discontinue extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'subscription_id',
        'final_amount',
        'settlement_amount',
        'paid_on',
        'reason',
        'status',
    ];
}
