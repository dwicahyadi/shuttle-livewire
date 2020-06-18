<?php

namespace App\Model;

use App\Models\Car;
use App\Models\Departure;
use App\Models\Driver;
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

    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }

    public function car()
    {
        return $this->belongsTo(Car::class);
    }
}
