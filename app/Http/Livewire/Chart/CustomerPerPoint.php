<?php

namespace App\Http\Livewire\Chart;

use Livewire\Component;

class CustomerPerPoint extends Component
{
    public $month;

    public function mount($month)
    {
        $this->month = $month;
    }
    public function render()
    {
        return view('livewire.chart.customer-per-point');
    }
}
