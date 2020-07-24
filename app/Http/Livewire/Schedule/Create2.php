<?php

namespace App\Http\Livewire\Schedule;

use App\Models\Point;
use App\Models\Schedule;
use Livewire\Component;

class Create2 extends Component
{
    public $step=1;
    public $seats = 10;
    public $departurePointId, $arrivalPointId, $price, $fromDate, $toDate, $prices;

    public $countPoints, $countTimes, $points;
    public $arrayPoints = [];
    public $routes;
    public $times;

    public function mount()
    {
        $this->countPoints = 3;
        $this->countTimes = 3;
        $this->routes = [];
        $this->points = Point::with('city')->get()->keyBy('id');
        $this->fromDate = date('Y-m-d');
        $this->toDate = date('Y-m-d');
    }
    public function render()
    {
        return view('livewire.schedule.create2', [
            'cities' => \App\Models\City::with(['points'])->get(),
        ]);
    }

    public function nextStep()
    {
        $this->step++;
    }

    public function previousStep()
    {
        $this->step--;
    }

    public function generateRoute(){
        for ($i = 0; $i < count($this->arrayPoints); $i++) {
            for ($j = $i ; $j < count($this->arrayPoints); $j++)
            {
                if (!isset($this->arrayPoints[$j+1]) )continue;
                if ($this->arrayPoints[$j+1] == $i )continue;
                $this->routes[] = [
                    'from' =>$this->arrayPoints[$i],
                    'to' =>$this->arrayPoints[$j+1],
                ];
            }
            $this->routes = array_map("unserialize", array_unique(array_map("serialize", $this->routes)));
            $this->routes = array_values($this->routes);
        }
    }

    public function resetPoint()
    {
        $this->arrayPoints = [];
        $this->routes = [];
    }

    public function updatedPrice()
    {
        $this->prices = explode(';',$this->price);
    }

    public function save()
    {
        $currentDate = $this->fromDate;

        while (strtotime($currentDate) <= strtotime($this->toDate)) {

            foreach ($this->times as $time) {
                $schedule = new Schedule();
                $schedule->seats = $this->seats;
                $schedule->save();
                foreach ($this->routes as $index => $route)
                {
                    $h = $time[$route['from']]['hour'];
                    $m = $time[$route['from']]['minute'];
                    $code = $this->points[$route['from']]->code
                        .$this->points[$route['to']]->code
                        .date('ymd',strtotime($currentDate))
                        .$h.$m
                        .$schedule->id;

                    $schedule->departures()->create([
                        'code' => $code,
                        'date' => $currentDate,
                        'time' => $h.":".$m.":00",
                        'departure_point_id' => $route['from'],
                        'arrival_point_id' => $route['to'],
                        'price' =>$this->prices[$index],
                        'status' => 'available',
                        'is_open' => true
                    ]);


                }
            }


            $currentDate = date ("Y-m-d", strtotime("+1 day", strtotime($currentDate)));

        }
        session()->flash('message', 'Berhasil disimpan');
        return route('schedule.create');
    }
}
