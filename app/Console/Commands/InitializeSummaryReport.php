<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class InitializeSummaryReport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'report:init';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Re-create summary report';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        DB::select(DB::raw('TRUNCATE TABLE summary_reports'));
        $this->info('OK temp table empty');

        DB::select(DB::raw('UPDATE tickets t LEFT JOIN departures d ON t.departure_id = d.id
        SET
        t.departure_point_id = d.departure_point_id
        WHERE
        t.departure_point_id is null'));
        $this->info('OK required field filled!');

        DB::select(DB::raw('UPDATE tickets set status = "cancel" where is_cancel = 1'));
        $this->info('OK cancel status updated!');

    }
}
