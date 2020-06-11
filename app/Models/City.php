<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $fillable = ['code','name'];

    public function points()
    {
        return $this->hasMany(Point::class);
    }
}
