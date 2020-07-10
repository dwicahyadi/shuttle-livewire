<?php

namespace App\Http\Livewire\Reservation\Partial;

use App\Helpers\SmsHelper;
use App\Jobs\SendSms;
use App\Models\Car;
use App\Models\City;
use App\Models\Customer;
use App\Models\Departure;
use App\Models\Discount;
use App\Models\Driver;
use App\Models\Point;
use App\Models\Ticket;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class Schedules extends Component
{
    use WithPagination;

    public $isFindTicket;
    public $cities, $discounts, $cars, $drivers;
    public $departurePointId, $arrivalPointId, $date, $departurePoint, $arrivalPoint, $discountId, $discount;
    public $search, $searchReults;

    public $departures, $selectedDepartureId, $selectedDeparture , $selectedReservation, $totalSeats, $paymentMethod;


    protected $updatesQueryString = ['date','departurePointId','arrivalPointId','selectedDepartureId',];

    protected $listeners = [
        'saved'=>'$refresh',
        'getDeparture'
    ];

    public function mount()
    {
        $this->cities = City::with(['points'])->get();
        $this->departures = [];
        $this->searchReults = [];
        $this->date = request('date');
        $this->departurePointId = request('departurePointId') ?? Auth::user()->point_id;
        $this->arrivalPointId = request('arrivalPointId');

        if(!$this->arrivalPointId)
        {
            if($this->departurePointId == 1)
            {
                $this->arrivalPointId = 2;
            }else{
                $this->arrivalPointId = 1;
            }
        }
        $this->selectedDepartureId = request('selectedDepartureId');
        $this->setDeparturePoint();
        $this->setArrivalPoint();
    }
    public function render()
    {
        if(!$this->date) $this->date = date('Y-m-d');
        $this->departures = Departure::whereDate('date',$this->date)
            ->where('arrival_point_id',$this->arrivalPointId)
            ->where('departure_point_id',$this->departurePointId)
            ->where('is_open',1)
            ->get();
        return view('livewire.reservation.partial.schedules');
    }

    public function setDeparturePoint()
    {
        $this->departurePoint = Point::with('city')->find($this->departurePointId);
    }
    public function setArrivalPoint()
    {
        $this->arrivalPoint = Point::with('city')->find($this->arrivalPointId);
    }

    public function findDepartures()
    {
        $this->selectedDeparture = null;
        $this->departures = Departure::with(['schedule'])->whereDate('date',$this->date)
            ->where('arrival_point_id',$this->arrivalPointId)
            ->where('departure_point_id',$this->departurePointId)
            ->where('is_open',1)
            ->get();
    }

    public function switchPoint()
    {
        $temp = $this->arrivalPointId;
        $this->arrivalPointId = $this->departurePointId;
        $this->departurePointId = $temp;
        $this->setArrivalPoint();
        $this->setDeparturePoint();
        $this->findDepartures();
    }

    public function getDeparture($departureId)
    {
        $this->selectedDepartureId = $departureId;
    }

}

