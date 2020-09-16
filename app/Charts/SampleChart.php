<?php

declare(strict_types = 1);

namespace App\Charts;

use Carbon\Carbon;
use Chartisan\PHP\Chartisan;
use ConsoleTVs\Charts\BaseChart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use function App\Charts\get as getAlias;

class SampleChart extends BaseChart
{
    public function handler(Request $request): Chartisan
    {
        $endOfDay = Carbon::now()->endOfDay();
        $data = get('chart_monthly_customer', function () {
            return DB::table('summary_reports')->select(DB::raw('count(id) as `data`'), DB::raw("DATE_FORMAT(date, '%M %Y') month"))
                ->groupby('month')
                ->where('status', 'paid')
                ->orderBy('date')
                ->get()->keyBy('month');
        }, $endOfDay);
        $chart = Chartisan::build()
            ->labels($data->keys()->toArray());

        $chart->dataset('Sample', $data->pluck('data')->values()->toArray());
        return $chart;
    }
}
