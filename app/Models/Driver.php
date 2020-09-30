<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }
}
