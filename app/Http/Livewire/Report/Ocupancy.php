<?php

namespace App\Http\Livewire\Report;

use App\Helpers\ReportHelper;
use App\Models\City;
use Livewire\Component;

class Ocupancy extends Component
{
    public $cities, $point;
    public $date;

    protected $updatesQueryString = ['point', 'date'];


    public function mount()
    {
        $this->cities = City::with(['points'])->get();
        $this->date = request('date') ?? date('Y-m-d');
        $this->point = request('point');
    }

    public function render()
    {
        $report = ReportHelper::ocupancy($this->point, $this->date);
        return view('livewire.report.ocupancy',['report'=>$report]);
    }
}
