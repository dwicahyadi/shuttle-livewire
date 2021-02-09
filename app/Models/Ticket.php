<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Ticket extends Model
{
    protected $fillable = [
        'departure_id',
        'phone',
        'name',
        'seat',
        'discount_id',
        'name_name',
        'discount_amount',
        'price',
        'status',
        'reservation_by',
        'reservation_at',
        'payment_by',
        'payment_at',
        'settlement_id',
        'departure_point_id',
        'note',
        'date',
    ];


    public function reservation()
    {
        return $this->belongsTo(Reservation::class);
    }

    public function departure()
    {
        return $this->belongsTo(Departure::class);
    }

    public function departure_point()
    {
        return $this->belongsTo(Point::class,'departure_point_id','id');
    }
}
