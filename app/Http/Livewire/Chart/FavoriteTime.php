<?php

namespace App\Http\Livewire\Chart;

use Livewire\Component;

class FavoriteTime extends Component
{
    public $month;

    public function mount($month)
    {
        $this->month = $month;
    }

    public function render()
    {
        return view('livewire.chart.favorite-time');
    }
}
