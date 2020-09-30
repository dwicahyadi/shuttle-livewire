<?php

declare(strict_types = 1);

namespace App\Charts;

use Chartisan\PHP\Chartisan;
use ConsoleTVs\Charts\BaseChart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustomerPerPoint extends BaseChart
{
    /**
     * Handles the HTTP request for the given chart.
     * It must always return an instance of Chartisan
     * and never a string or an array.
     */
    public function handler(Request $request): Chartisan
    {
        $data = DB::table('summary_reports')->select(DB::raw('count(id) as `data`'), 'departure_point')
            ->groupby('departure_point')
            ->where('status','paid')
            ->orderBy('date')
            ->whereMonth('date', $request['month'])
            ->get()->keyBy('departure_point');

        $chart = Chartisan::build()
            ->labels($data->keys()->toArray());


        $chart->dataset('Jumlah Penumpang', $data->pluck('data')->values()->toArray());
        return $chart;
    }
}
