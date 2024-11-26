<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Country extends Model
{

    use HasFactory;
    use SoftDeletes;

    const COUNTRY_ID = 1;

    protected $fillable = [
        'name',
        'code',
        'status',

    ];
}
