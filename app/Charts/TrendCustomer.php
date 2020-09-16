<?php

declare(strict_types = 1);

namespace App\Charts;

use Carbon\Carbon;
use Chartisan\PHP\Chartisan;
use ConsoleTVs\Charts\BaseChart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TrendCustomer extends BaseChart
{
    /**
     * Handles the HTTP request for the given chart.
     * It must always return an instance of Chartisan
     * and never a string or an array.
     */
    public function handler(Request $request): Chartisan
    {
        $endOfDay = Carbon::now()->endOfDay();
        $data = \Cache::get('chart_trend_customer', function () {
            $result = DB::table('summary_reports')->select(DB::raw('count(id) as `data`'), DB::raw("DATE_FORMAT(date, '%d %b') date"))
                ->groupby('date')
                ->where('status', 'paid')
                ->whereDate('date', '<', Carbon::now()->subDays(1))
                ->whereDate('date', '>', Carbon::now()->subDays(31))
                ->get()->keyBy('date');

            return $result ; }, $endOfDay);
        $chart = Chartisan::build()
            ->labels($data->keys()->toArray());

        $chart->dataset('Sample', $data->pluck('data')->values()->toArray());
        return $chart;
    }
}
