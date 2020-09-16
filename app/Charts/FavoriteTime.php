<?php

declare(strict_types = 1);

namespace App\Charts;

use Chartisan\PHP\Chartisan;
use ConsoleTVs\Charts\BaseChart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FavoriteTime extends BaseChart
{
    public ?bool $tooltip = true;

    /**
     * Handles the HTTP request for the given chart.
     * It must always return an instance of Chartisan
     * and never a string or an array.
     */
    public function handler(Request $request): Chartisan
    {
        $data = DB::table('summary_reports')->select(DB::raw('count(id) as `data`'), 'time')
            ->groupby('time')
            ->where('status','paid')
            ->orderBy('time')
            ->whereMonth('date', $request['month'])
            ->get()->keyBy('time');

        $chart = Chartisan::build()
            ->labels($data->keys()->toArray());


        $chart->dataset('Sample', $data->pluck('data')->values()->toArray());
        return $chart;
    }
}
