<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class State extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    protected $fillable = [
        'country_id',
        'name',
        'code',
        'status',

    ];

    public function country()
    {
        return $this->hasOne(Country::class, 'id', 'country_id');
    }
}
