<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $fillable = ['departure_id',
        'departure_id',
        'departure_point_id',
        'arrival_point_id',
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
        'settlment_id',];

    public function reservation()
    {
        return $this->belongsTo(Reservation::class);
    }

    public function departure()
    {
        return $this->belongsTo(Departure::class);
    }
}
