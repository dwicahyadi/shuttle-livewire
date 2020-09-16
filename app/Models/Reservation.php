<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Spatie\Activitylog\Traits\LogsActivity;

class Reservation extends Model
{
    protected $fillable = [
        'customer_id',
        'code',
        'count_reschedule',
        'expired_at',
        'is_expired',
        'user_id',
        'note',
        'transfer_amount',
    ];

    public function tickets()
    {
        return $this->hasMany(Ticket::class)->whereNull('tickets.is_cancel');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function expired()
    {
        return DB::table($this->getTable())->where('expired_at','>=', Carbon::now());
    }
}
