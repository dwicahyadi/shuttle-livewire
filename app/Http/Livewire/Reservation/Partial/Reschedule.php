<?php

namespace App\Http\Livewire\Reservation\Partial;

use App\Models\Car;
use App\Models\City;
use App\Models\Departure;
use App\Models\Discount;
use App\Models\Driver;
use App\Models\Point;
use App\Models\Ticket;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class Reschedule extends Component
{
    use WithPagination;

    public $cities, $discounts, $cars, $drivers;
    public $departurePointId, $arrivalPointId, $date, $departurePoint, $arrivalPoint, $discountId, $discount;
    public $search, $searchReults;

    public $departures, $selectedDepartureId, $selectedDeparture, $selectedReservation, $totalSeats, $paymentMethod;

    public $phone, $name, $address, $departureId, $subTotal;
    public $selectedSeats = [];
    public $suggestCustomers;
    public $customer;

    public $reservation;
    public $selectedTickets = [];
    public $car_id, $driver_id, $costs;

    protected $updatesQueryString = ['date', 'departurePointId', 'arrivalPointId', 'selectedDepartureId',];

    protected $listeners = [
        'saved' => '$refresh',
        'initReschedule'
    ];

    public function mount()
    {
        $this->cities = City::with(['points'])->get();
        $this->discounts = Discount::where('active', 1)->get();
        $this->cars = Car::where('active', 1)->get();
        $this->drivers = Driver::where('active', 1)->get();
        $this->departures = [];
        $this->searchReults = [];
        $this->date = request('date');
        $this->departurePointId = request('departurePointId') ?? Auth::user()->point_id;
        $this->arrivalPointId = request('arrivalPointId');

        if (!$this->arrivalPointId) {
            if ($this->departurePointId == 1) {
                $this->arrivalPointId = 2;
            } else {
                $this->arrivalPointId = 1;
            }
        }
        $this->selectedDepartureId = request('selectedDepartureId');
        $this->setDeparturePoint();
        $this->setArrivalPoint();
        $this->getDeparture($this->selectedDepartureId);
    }
    public function render()
    {
        if (!$this->date) $this->date = date('Y-m-d');
        $this->departures = Departure::whereDate('date', $this->date)
            ->where('arrival_point_id', $this->arrivalPointId)
            ->where('departure_point_id', $this->departurePointId)
            ->where('is_open', 1)
            ->get();
        return view('livewire.reservation.partial.reschedule');
    }

    public function setDeparturePoint()
    {
        $this->departurePoint = Point::with('city')->find($this->departurePointId);
    }
    public function setArrivalPoint()
    {
        $this->arrivalPoint = Point::with('city')->find($this->arrivalPointId);
    }

    public function setDiscount()
    {
        $this->discount = Discount::find($this->discountId);
        $this->sumPrice();
    }

    public function findDepartures()
    {
        $this->selectedDeparture = null;
        $this->departures = Departure::with(['schedule'])->whereDate('date', $this->date)
            ->where('arrival_point_id', $this->arrivalPointId)
            ->where('departure_point_id', $this->departurePointId)
            ->where('is_open', 1)
            ->get();
    }

    public function switchPoint()
    {
        $temp = $this->arrivalPointId;
        $this->arrivalPointId = $this->departurePointId;
        $this->departurePointId = $temp;
        $this->setArrivalPoint();
        $this->setDeparturePoint();
        $this->findDepartures();
        $this->isNew = false;
    }

    public function getDeparture($departureId)
    {
        $this->subTotal = 0;
        $this->selectedReservation = null;
        $this->selectedDepartureId = $departureId;
        $this->selectedDeparture = Departure::with(['schedule', 'tickets'])
            ->where('id', $departureId)->first();
        $this->totalSeats = $this->selectedDeparture->schedule->seats ?? 0;
        $this->driver_id = $this->selectedDeparture->schedule->driver_id ?? 0;
        $this->car_id = $this->selectedDeparture->schedule->car_id ?? 0;
    }

    public function pickSeat($seat)
    {
        $this->isNew = true;
        $this->selectedReservation = null;
        if (in_array($seat, $this->selectedSeats)) {
            $key = array_search($seat, $this->selectedSeats);
            unset($this->selectedSeats[$key]);
        } else {
            $this->selectedSeats[] = $seat;
        }
        sort($this->selectedSeats);
    }

    public function initReschedule(array $tickets)
    {
        $this->selectedTickets = $tickets;
    }

    public function reschedule()
    {
        foreach ($this->selectedTickets as $id => $ticket) {
            $updateTicket = Ticket::find($ticket);
            $updateTicket->departure_id = $this->selectedDepartureId;
            $updateTicket->seat = $this->selectedSeats[$id];
            $updateTicket->save();
        }

        $this->emitUp('successRescedule');
        $this->emitUp('saved');
    }
}
