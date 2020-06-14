<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Departure extends Model
{
    protected $fillable = [
        'code',
        'shedule_id',
        'departure_point_id',
        'arrival_point_id',
        'date',
        'time',
        'status',
        'price',
        'is_open'
    ];

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }
}
