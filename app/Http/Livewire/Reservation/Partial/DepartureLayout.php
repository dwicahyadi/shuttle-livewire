<?php

namespace App\Http\Livewire\Reservation\Partial;

use App\Models\Departure;
use Livewire\Component;

class DepartureLayout extends Component
{
    public $departure, $bookedSeats, $isNew = false;
    public $selectedSeats = [];

    protected $listeners = [
        'selectDeparture'
    ];

    public function mount($departureId)
    {
        $this->departure = Departure::find($departureId);
    }

    public function render()
    {
        return view('livewire.reservation.partial.departure-layout');
    }

    public function selectDeparture($departureId)
    {
        $this->selectedSeats = [];
        $this->isNew = false;
        $this->departure = Departure::with(['schedule.tickets'=>function($q){
            return $q->where('tickets.arrival_point_id', 'departures.arrival_point_id')
                ->orWhere('tickets.departure_point_id', 'departures.departure_point_id');
        },'departure_point','arrival_point', 'schedule.driver', 'schedule.car'])
            ->where('id', $departureId)->first();

        $this->bookedSeats = $this->departure->schedule->tickets->keyBy((String) 'seats');
        $this->emit('clearNewForm');

    }

    public function pickSeat($seat)
    {
        if (in_array($seat, $this->selectedSeats)) {
            $key = array_search($seat, $this->selectedSeats);
            unset($this->selectedSeats[$key]);
        } else {
            $this->selectedSeats[] = $seat;
        }
        sort($this->selectedSeats);

        if(!$this->isNew)
        {
            $this->isNew = true;
            if (count($this->selectedSeats))
                $this->emit('setNewForm',$this->departure->id);
        }

        $this->emit('selectedSeats',$this->selectedSeats);


    }
}
