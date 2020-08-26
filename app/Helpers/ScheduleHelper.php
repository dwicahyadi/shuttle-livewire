<?php
namespace App\Helpers;


use App\Models\Departure;
use App\Models\Ticket;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ScheduleHelper
{
    public static function findByPoint(int $departure_point_id, int $arrival_point_id, String $date)
    {
        $data = Departure::with(['schedule' => function ($q) {
            return $q->withCount('tickets');
        }])
            ->whereDate('date', $date)
            ->where('arrival_point_id', $arrival_point_id)
            ->where('departure_point_id', $departure_point_id)
            ->where('is_open', 1)
            ->get();
        return $data;
    }

    public static function getDeparture(int $departure_id)
    {
        return Departure::with(['departure_point','arrival_point','schedule','schedule.car','schedule.driver', 'schedule.tickets'])
        ->find($departure_id);
    }
}
