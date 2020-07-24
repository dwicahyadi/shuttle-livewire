<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = ['phone',
        'name',
        'address',
        'count_reservation_finished',
        'count_reservation',];

    protected $hidden = ['created_at','updated_at'];

}
