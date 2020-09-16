<?php

namespace App\Console\Commands;

use App\Models\SummaryReport;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class GenerateReport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'report:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate all transaction to report table';

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
     * @return void
     */
    public function handle()
    {
        $data = DB::select(DB::raw("select
       t.id,
       d.code as departure_code,
       d.date,
       d.time,
       r.code as reservation_code,
       t.name,
       t.phone,
       dc.name as departure_city,
       dp.name as departure_point,
       ac.name as arrival_city,
       ap.name as arrival_point,
       if(t.discount_name is not null, t.discount_name, 'Umum') as discount_name,
       t.discount_amount,
       t.price,
       t.seat,
       t.status,
       rb.name as reservation_by,
       pb.name as payment_by,
       t.settlement_id
from tickets t
    left join reservations r on t.reservation_id = r.id
left join departures d on t.departure_id = d.id
left join schedules s on d.schedule_id = s.id
left join points dp on t.departure_point_id = dp.id
left join cities dc on dp.city_id = dc.id
left join points ap on d.arrival_point_id = ap.id
left join cities ac on ap.city_id = ac.id
left join users rb on t.reservation_by = rb.id
left join users pb on t.payment_by = pb.id"));

        $data = $this->convertToArray($data);

        foreach (array_chunk($data,1000) as $item) {
            SummaryReport::insertOrUpdate($item);
        }
        $this->info("Generate ".count($data)." rows");
    }

    private function convertToArray($data) : array
    {
        $newArray = [];
        foreach ($data as $datum)
        {
            array_push($newArray, (array) $datum);
        }
        return $newArray;
    }
}
