<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Point extends Model
{
    protected $fillable = [
        'city_id','code','name','address','phone','active'
    ];

    protected $hidden = ['created_at','updated_at'];

    public function city()
    {
        return $this->belongsTo(City::class);
    }
}
