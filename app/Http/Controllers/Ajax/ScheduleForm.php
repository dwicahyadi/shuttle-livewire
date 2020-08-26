<?php

namespace App\Http\Controllers\Ajax;

use App\Helpers\ScheduleHelper;
use App\Http\Controllers\Controller;
use App\Models\City;
use Illuminate\Http\Request;

class ScheduleForm extends Controller
{
    public function getArrivalForm($city_id)
    {
        return City::where('id','!=',$city_id)->get();
    }

    public function findSchedules(Request $request)
    {
        $departures =  ScheduleHelper::findByPoint($request['departure_point_id'], $request['arrival_point_id'], $request['date']);
        return view('reservation.partials.schedule-list',compact('departures'));
    }

    public function getDeparture(Request $request)
    {
        $departure =  ScheduleHelper::getDeparture($request['departure_id']);
        return view('reservation.partials.departure-layout', compact('departure'));
    }
}
