<?php

namespace App\Http\Livewire\Schedule;

use App\Imports\ImportSchedules;
use App\Models\Point;
use App\Models\Schedule;
use Livewire\Component;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;

class Upload extends Component
{
    use WithFileUploads;

    public  $file;
    public $fromDate, $toDate;

    public function mount()
    {
        $this->fromDate = date('Y-m-d');
        $this->toDate = date('Y-m-d');
    }
    public function render()
    {
        return view('livewire.schedule.upload');
    }

    public function save()
    {
        $array = Excel::toArray(new ImportSchedules(), $this->file );
        $points = Point::get()->keyBy('code');

        $currentDate = $this->fromDate;

        while (strtotime($currentDate) <= strtotime($this->toDate)) {
            foreach ($array[0] as $row) {
                if(!$row['point_1']) continue;

                $schedule = new Schedule();
                $schedule->seats = $row['seats'];
                $schedule->car_id = $row['car_id'];
                $schedule->driver_id = $row['driver_id'];
                $schedule->note = $row['note'];
                $schedule->save();

                $routes = [
                    ['from'=>$points[$row['point_1']], 'to'=>$points[$row['point_2']], 'departure_time'=> $row['departure_time_1'], 'price'=> $row['price_1']],
                    ['from'=>$points[$row['point_1']], 'to'=>$points[$row['point_3']], 'departure_time'=> $row['departure_time_1'], 'price'=> $row['price_2']],
                    ['from'=>$points[$row['point_2']], 'to'=>$points[$row['point_3']], 'departure_time'=> $row['departure_time_2'], 'price'=> $row['price_3']],
                ];

                foreach ($routes as $route)
                {
                    $code = $route['from']->code
                        .$route['to']->code
                        .date('ymd',strtotime($currentDate))
                        .$route['departure_time']
                        .$schedule->id;

                    $schedule->departures()->create([
                        'code' => $code,
                        'date' => $currentDate,
                        'time' => $route['departure_time'],
                        'departure_point_id' => $route['from']->id,
                        'arrival_point_id' => $route['to']->id,
                        'price' =>$route['price'],
                        'status' => 'available',
                        'is_open' => true
                    ]);
                }

            }
            $currentDate = date ("Y-m-d", strtotime("+1 day", strtotime($currentDate)));

        }
        session()->flash('message', 'Berhasil disimpan');
    }
}
