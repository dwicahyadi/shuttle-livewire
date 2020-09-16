<?php

namespace App\Http\Livewire\Report;

use App\Models\City;
use App\Models\SummaryReport;
use Livewire\Component;
use Livewire\WithPagination;

class Ticket extends Component
{
    use WithPagination;

    public $cities, $date, $point, $status;

    protected $updatesQueryString = ['point', 'date','status'];

    public function mount()
    {
        $this->cities = City::with(['points'])->get();
        $this->date = request('date') ?? date('Y-m-d');
        $this->point = request('point');
    }
    public function render()
    {
        $report = SummaryReport::query();
        if ($this->point) $report->where('departure_point', $this->point);
        if ($this->status) $report->where('status', $this->status);
        return view('livewire.report.ticket',['report'=>$report->whereDate("date",$this->date)->paginate(25)]);
    }
}
