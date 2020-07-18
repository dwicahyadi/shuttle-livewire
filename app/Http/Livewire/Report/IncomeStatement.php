<?php

namespace App\Http\Livewire\Report;

use App\Helpers\ReportHelper;
use App\Models\City;
use App\Models\Departure;
use App\Models\Ticket;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class IncomeStatement extends Component
{
    public $cities, $point;
    public $month;
    public $year;
    public $data;

    protected $updatesQueryString = ['date', 'point', 'month', 'year',];


    public function mount()
    {
        $this->cities = City::with(['points'])->get();
        $this->month= request('month') ?? (int) date('m');
        $this->year = request('year') ?? date('Y');
        $this->point = request('point') ?? 0;
    }
    public function render()
    {
        $report = ReportHelper::omzet($this->point, $this->month, $this->year);
        return view('livewire.report.income-statement',['report'=>$report]);
    }
}
