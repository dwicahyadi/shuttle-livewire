<?php

namespace App\Models;

use App\Models\Schedule;
use Illuminate\Database\Eloquent\Model;

class Departure extends Model
{
    protected $fillable = [
        'code',
        'schedule_id',
        'departure_point_id',
        'arrival_point_id',
        'date',
        'time',
        'status',
        'price',
        'is_open'
    ];

    protected $hidden = ['created_at','updated_at'];

    public function allTickets()
    {
        return $this->hasMany(Ticket::class);
    }
    public function tickets()
    {
        return $this->hasMany(Ticket::class)->whereNull('tickets.is_cancel');
    }

    public function schedule()
    {
        return $this->belongsTo(Schedule::class);
    }

    public function arrival_point()
    {
        return $this->belongsTo(Point::class,'arrival_point_id','id');
    }

    public function departure_point()
    {
        return $this->belongsTo(Point::class,'departure_point_id','id');
    }
}
