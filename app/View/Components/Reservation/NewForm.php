<?php

namespace App\View\Components\Reservation;

use App\Models\Discount;
use Illuminate\View\Component;

class NewForm extends Component
{
    public $discounts;
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
        $this->discounts = Discount::where('active',1)->get();
        return view('components.reservation-new-form');
    }
}
