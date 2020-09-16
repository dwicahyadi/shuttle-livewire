<?php

namespace App\Providers;

use App\Charts\CustomerPerMonth;
use App\Charts\CustomerPerPoint;
use App\Charts\FavoriteTime;
use App\Charts\SampleChart;
use App\Charts\TrendCustomer;
use ConsoleTVs\Charts\Registrar as Charts;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(Charts $charts)
    {
        Schema::defaultStringLength(191);
        if(Schema::hasTable('settings'))
        {
            config([
                'settings' => \App\Models\Setting::all([
                    'name','value'
                ])
                    ->keyBy('name')
                    ->transform(function ($setting) {
                        return $setting->value;
                    })
                    ->toArray()
            ]);
        }
        $charts->register([
            SampleChart::class,
            CustomerPerPoint::class,
            CustomerPerMonth::class,
            FavoriteTime::class,
            TrendCustomer::class,
        ]);
    }
}
