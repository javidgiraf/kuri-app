<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Scheme extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'title',
        'scheme_type_id',
        'total_period',
        'description',
        'status'
    ];
    // public function getFormattedTotalAmountAttribute()
    // {
    //     return number_format($this->attributes['total_amount'], 2);
    // }
    // public function getFormattedScheduleAmountAttribute()
    // {
    //     return number_format($this->attributes['schedule_amount'], 2);
    // }



    public function setFormattedTotalPeriodAttribute($value)
    {
        $multipliedPrice = $value * 12;
        $this->attributes['total_period'] = $value * $multipliedPrice;
    }
    public function schemeType()
   {
       return $this->belongsTo(SchemeType::class, 'scheme_type_id');
   }
}
