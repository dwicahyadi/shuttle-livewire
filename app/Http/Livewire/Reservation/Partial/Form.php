<?php

namespace App\Http\Livewire\Reservation\Partial;

use App\Models\Departure;
use Livewire\Component;

class Form extends Component
{
    public $isNew = false;
    public $reservation = null;
    public $departureId;

    protected $listeners = [
        'setNewForm', 'clearNewForm'
    ];
    public function render()
    {
        return view('livewire.reservation.partial.form');
    }

    public function setNewForm($departureId)
    {
        $this->departureId = $departureId;
        $this->reservation = null;
        $this->isNew = true;
    }

    public function clearNewForm()
    {
        $this->departureId = 0;
        $this->reservation = null;
        $this->isNew = false;
    }
}
