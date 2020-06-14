<?php

namespace App\Http\Livewire\Schedule;

use App\Models\Car;
use App\Models\City;
use App\Models\Departure;
use App\Models\Discount;
use App\Models\Driver;
use App\Models\Point;
use Livewire\Component;

class Manage extends Component
{
    public $cities, $discounts, $cars, $drivers;
    public $departurePointId, $arrivalPointId, $date, $departurePoint, $arrivalPoint, $discountId, $discount;

    public $departures, $selectedDepartureId, $selectedDeparture , $selectedReservation;

    public function mount()
    {
        $this->cities = City::with(['points'])->get();
        $this->discounts = Discount::where('active',1)->get();
        $this->cars = Car::where('active',1)->get();
        $this->drivers = Driver::where('active',1)->get();
        $this->departures = [];
        $this->date = request('date');
        $this->departurePointId = request('departurePointId');
        $this->arrivalPointId = request('arrivalPointId');
        $this->selectedDepartureId = request('selectedDepartureId');
        $this->setDeparturePoint();
        $this->setArrivalPoint();
        $this->selectedDeparture = Departure::with(['tickets'])
            ->where('id',$this->selectedDepartureId)->first();
    }
    public function render()
    {
        if(!$this->date) $this->date = date('Y-m-d');
        $this->departures = Departure::whereDate('date',$this->date)
            ->where('arrival_point_id',$this->arrivalPointId)
            ->where('departure_point_id',$this->departurePointId)
            ->get();
        return view('livewire.schedule.manage');
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
        $this->departures = Departure::whereDate('date',$this->date)
            ->where('arrival_point_id',$this->arrivalPointId)
            ->where('departure_point_id',$this->departurePointId)
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

    public function toggleStatus($departureId)
    {
        $departure = Departure::find($departureId);
        $departure->is_open = !$departure->is_open;
        $departure->save();

    }
}
