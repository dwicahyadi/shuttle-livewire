<?php

namespace App\Http\Livewire\Reservation\Partial;

use App\Helpers\ScheduleHelper;
use App\Models\City;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class FindSchedule extends Component
{
    public $date, $cities, $departures, $onlyFilled, $departureId;
    public $departurePointId, $arrivalPoints, $arrivalPointId;

    public function mount()
    {
        $this->date = Carbon::now()->toDateString();
        $this->cities = City::with(['points'])->whereHas('points')->get();
        $this->arrivalPoints = [];
        $this->departures = [];
        $this->departureId = Auth::user()->point_id;
        $this->onlyFilled = false;
        $this->onlyFilled = false;
    }
    public function render()
    {
        return view('livewire.reservation.partial.find-schedule');
    }
    public function findArrivalPoints()
    {
        $this->arrivalPoints = City::with(['points'=>
            function($q){
            return $q->where('points.id','!=',$this->departurePointId);
            }])->whereHas('points')->get();
    }

    public function find()
    {
        $this->departures = ScheduleHelper::findByPoint($this->departurePointId, $this->arrivalPointId, $this->date);
    }

    public function selectDeparture($departureId)
    {
        $this->departureId = $departureId;
        $this->emit('selectDeparture', ['departureId'=>$this->departureId]);
    }
}

