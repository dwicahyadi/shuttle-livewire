<?php

namespace App\Http\Livewire\Schedule;

use App\Model\Schedule;
use App\Models\Point;
use Livewire\Component;

class Create extends Component
{
    public $step=0;
    public $seats = 10;
    public $departurePointId, $arrivalPointId, $price, $fromDate, $toDate;
    public $departurePoint, $arrivalPoint;
    public $newHour, $newMinute;
    public $departureTimes = [];

    public function render()
    {
        return view('livewire.schedule.create',[
            'cities'=>\App\Models\City::with(['points'])->get(),
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

    public function setDeparturePoint()
    {
        $this->departurePoint = Point::with('city')->find($this->departurePointId);
    }
    public function setArrivalPoint()
    {
        $this->arrivalPoint = Point::with('city')->find($this->arrivalPointId);
    }

    public function addDepartureTime()
    {
        $newDepartureTime = $this->createTime();
        array_push($this->departureTimes,$newDepartureTime);
        $this->departureTimes = array_unique($this->departureTimes);
    }

    public function removeDepartureTime($key)
    {
        unset($this->departureTimes[$key]);
    }

    public function save()
    {
        $currentDate = $this->fromDate;

        while (strtotime($currentDate) <= strtotime($this->toDate)) {
            $schedule = new Schedule();
//            $schedule->code = date('ymdhis').rand(0,999);
            $schedule->seats = $this->seats;
            $schedule->save();

            foreach ($this->departureTimes as $departureTime)
            {
                $code = $this->departurePoint->code
                    .$this->arrivalPoint->code
                    .date('ymd',strtotime($currentDate))
                    .str_replace(':','',$departureTime)
                    .$schedule->id;

                $schedule->departures()->create([
                    'code' => $code,
                    'date' => $currentDate,
                    'time' => $departureTime,
                    'arrival_point_id' => $this->arrivalPointId,
                    'departure_point_id' => $this->departurePointId,
                    'price' =>$this->price,
                    'status' => 'open',
                ]);
            }
            $currentDate = date ("Y-m-d", strtotime("+1 day", strtotime($currentDate)));

        }
        session()->flash('message', 'Berhasil disimpan');
        $this->resetForm();
    }

    /**
     * @return string
     */
    private function createTime(): string
    {
        $time = str_pad($this->newHour >= 24 ? 23 : $this->newHour,'2','0',STR_PAD_LEFT);
        $time .= ':';
        $time .= str_pad($this->newMinute >= 59 ? 59 : $this->newMinute,'2','0');
        return $time;
    }

    private function resetForm()
    {
        $this->step = 0;
        $this->seats = 10;
        $this->departurePointId = 0;
        $this->arrivalPointId = 0;
        $this->price = null;
        $this->fromDate = null;
        $this->toDate=null;
        $this->departurePoint= null;
        $this->arrivalPoint=null;
        $this->newHour =0;
        $this->newMinute = 0;
        $this->departureTimes = [];
    }

}
