<?php

namespace App\View\Components\Reservation;

use App\Models\Departure;
use Illuminate\View\Component;

class SeatLayout extends Component
{
    public $departure;

    /**
     * Create a new component instance.
     *
     * @param Departure $departure
     */
    public function __construct(Departure $departure)
    {
        $this->departure = $departure;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.reservation.seat-layout');
    }
}
