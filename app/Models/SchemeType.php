<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchemeType extends Model
{
    use HasFactory;

    const FIXED_PLAN = 2;

    protected $guarded = [];
}
