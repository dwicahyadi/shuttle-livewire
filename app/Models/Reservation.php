<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $fillable = [
        'customer_id',
        'code',
        'count_reschedule',
        'expired_at',
        'is_expired',
        'user_id',
    ];

    public function tickets()
    {
        return $this->hasMany(Ticket::class)->whereNull('tickets.is_cancel');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
