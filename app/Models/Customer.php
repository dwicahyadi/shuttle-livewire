<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Customer extends Model
{
    protected $fillable = ['phone',
        'name',
        'address',
        'count_reservation_finished',
        'count_reservation',
        'member'
        ];

    public function reservations(){
        return $this->hasMany(Reservation::class);
    }

    public function tickets(){
        return $this->hasMany(Ticket::class,'phone','phone');
    }

}
