<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
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
}
