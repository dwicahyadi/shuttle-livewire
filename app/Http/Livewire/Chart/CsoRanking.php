<?php

namespace App\Http\Livewire\Chart;

use App\Models\SummaryReport;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class CsoRanking extends Component
{
    public $month;

    public function mount($month)
    {
        $this->month = $month;
    }
    public function render()
    {
        $data = DB::table('summary_reports')
            ->select('reservation_by', DB::raw('count(id) as val'))
            ->groupBy(['reservation_by'])
            ->orderBy('val','desc')
            ->whereMonth('date',$this->month)
            ->get();
        return view('livewire.chart.cso-ranking', compact('data'));
    }
}
