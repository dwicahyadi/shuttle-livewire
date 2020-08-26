<?php

namespace App\View\Components\Reservation;

use App\Models\City;
use Illuminate\View\Component;

class ScheduleForm extends Component
{
    public $id;
    public $cities;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        $this->cities = City::with(['points'])->get();
        return view('components.reservation.schedule-form');
    }
}
