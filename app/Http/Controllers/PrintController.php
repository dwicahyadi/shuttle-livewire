<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Schedule;
use App\Models\Settlement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PrintController extends Controller
{
    public function ticket(Reservation $reservation)
    {
        if($reservation->tickets[0]->count_print > 0)
        {
            if(!Auth::user()->can('Re-print'))
                return 'You dont have permission to perform this action!';
        }
        $reservation->tickets()->update(['count_print' => \Illuminate\Support\Facades\DB::raw('count_print+1')]);
        return view('prints.ticket',['reservation'=>$reservation]);
    }

    public function manifest (Schedule $schedule){
        if (!$schedule ->car_id && !$schedule ->driver_id && !$schedule ->costs )
        {
            return 'Driver and or Car and or Costs cannot be null';
        }
        $schedule->departures()->update(['is_manifested'=>true]);
        return view('prints.manifest', ['schedule'=>$schedule]);
    }

    public function settlement (Settlement $settlement){

        return view('prints.settlement', ['settlement'=>$settlement]);
    }
}
