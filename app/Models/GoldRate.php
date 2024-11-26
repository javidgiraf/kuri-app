<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GoldRate extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'per_gram',
        'per_pavan',
        'date_on',
        'status',
    ];
}
