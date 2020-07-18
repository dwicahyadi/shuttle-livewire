<?php

namespace App\Models;

use App\Models\Car;
use App\Models\Departure;
use App\Models\Driver;
use App\Models\Ticket;
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

    public function tickets()
    {
        return $this->hasManyThrough(Ticket::class,Departure::class)->whereNull('tickets.is_cancel');
    }

    public function paidTickets()
    {
        return $this->hasManyThrough(Ticket::class,Departure::class)->whereNull('tickets.is_cancel')->whereNotNull('tickets.payment_by');
    }

    public function sumTicketsAmount()
    {
        return $this->paidTickets()->selectRaw('departure_id, sum(tickets.price) as amount')->groupBy('departure_id');
    }
}
