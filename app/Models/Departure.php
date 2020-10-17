<?php

namespace App\Models;

use App\Models\Schedule;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

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
    public function city()
    {
        return $this->hasOneThrough(City::class, Point::class,'city_id','id','departure_point_id');
    }

    public function getDateAttribute($value)
    {
        return Carbon::parse($value)->format('d M Y');
    }

    public function getTimeAttribute($value)
    {
        return Str::limit($value, 5);
    }
}
