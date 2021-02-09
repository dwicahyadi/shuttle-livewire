<?php

namespace App\Http\Livewire\Report;

use App\Models\Schedule;
use Livewire\Component;

class OperationalCost extends Component
{
    public $startDate, $endDate;

    public function mount()
    {
        $this->startDate = request('startDate') ?? date('Y-m-d');
        $this->endDate = request('endDate') ?? date('Y-m-d');
    }

    public function render()
    {
        $report = Schedule::with(['car','driver','departures'])
            ->whereHas('departures',function($q){
                return $q->whereDate('date','>=',$this->startDate)
                    ->whereDate('date','<=', $this->endDate)
                    ->where('is_manifested',true);
            })
            ->orderBy('updated_at')
            ->get();
        return view('livewire.report.operational-cost', ['report'=>$report]);
    }

}
