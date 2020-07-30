<?php

namespace App\Imports;

use App\Models\Point;
use App\Models\Schedule;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToArray;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ImportSchedules implements ToArray, WithHeadingRow
{

    public function model(array $row)
    {
        $points = Point::get()->keyBy('code');
        $routes = [
            ['from'=>$points[$row['point_1']], 'to'=>$points[$row['point_2']], 'departure_time'=> $row['departure_time_1'], 'price'=> $row['price_1']],
            ['from'=>$points[$row['point_1']], 'to'=>$points[$row['point_3']], 'departure_time'=> $row['departure_time_1'], 'price'=> $row['price_2']],
            ['from'=>$points[$row['point_2']], 'to'=>$points[$row['point_3']], 'departure_time'=> $row['departure_time_2'], 'price'=> $row['price_3']],
        ];



        $schedule = new Schedule();
        $schedule->seats = $row['seats'];
        $schedule->car_id = $row['car_id'];
        $schedule->driver_id = $row['driver_id'];
        $schedule->note = $row['note'];
        $schedule->save();




        foreach ($routes as $index => $route)
        {
            $code = $route['from']->code
                .$route['to']->code
                .date('ymd',strtotime($this->date))
                .$route['departure_time']
                .$schedule->id;

            $schedule->departures()->create([
                'code' => $code,
                'date' => $this->date,
                'time' => $route['departure_time'],
                'departure_point_id' => $route['from']->id,
                'arrival_point_id' => $route['to']->id,
                'price' =>$route['price'],
                'status' => 'available',
                'is_open' => true
            ]);
        }

        return $schedule;
    }

    public function array(array $array)
    {
        return $array;
    }
}
