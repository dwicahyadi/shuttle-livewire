<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReservationFormController extends Controller
{
    public function index()
    {
        return view('reservation.index');
    }
}
