<?php

namespace App\Model;

use App\Models\Departure;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $fillable = [
        'code',
'car_id',
'driver_id',
'cost',
'seats',
    ];

    public function departures()
    {
        return $this->hasMany(Departure::class);
    }
}
