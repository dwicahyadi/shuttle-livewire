<?php

namespace App\Http\Livewire;

use App\Helpers\BillHelper;
use App\Models\Car;
use App\Models\City;
use App\Models\Customer;
use App\Models\Departure;
use App\Models\Discount;
use App\Models\Driver;
use App\Models\Point;
use App\Models\Ticket;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

define('CODE_PESSENGER_RESERVATION','PSG');

class Reservation extends Component
{
    use WithPagination;

    public $isNew, $isManifestForm, $isPrint, $isFindTicket;
    public $cities, $discounts, $cars, $drivers;
    public $departurePointId, $arrivalPointId, $date, $departurePoint, $arrivalPoint, $discountId, $discount;
    public $search, $searchReults;

    public $departures, $selectedDepartureId, $selectedDeparture , $selectedReservation, $totalSeats;

    public $phone, $name, $address, $departureId, $subTotal;
    public $selectedSeats = [];
    public $suggestCustomers;
    public $customer;

    public $reservation;

    public $car_id, $driver_id, $costs;

    protected $updatesQueryString = ['date','departurePointId','arrivalPointId','selectedDepartureId',];

    protected $listeners = [
        'saved'=>'$refresh'
    ];

    public function mount()
    {
        $this->cities = City::with(['points'])->get();
        $this->discounts = Discount::where('active',1)->get();
        $this->cars = Car::where('active',1)->get();
        $this->drivers = Driver::where('active',1)->get();
        $this->departures = [];
        $this->searchReults = [];
        $this->date = request('date');
        $this->departurePointId = request('departurePointId') ?? Auth::user()->point_id;
        $this->arrivalPointId = request('arrivalPointId');
        $this->selectedDepartureId = request('selectedDepartureId');
        $this->setDeparturePoint();
        $this->setArrivalPoint();
        $this->getDeparture($this->selectedDepartureId);
    }
    public function render()
    {
        if(!$this->date) $this->date = date('Y-m-d');
        $this->departures = Departure::whereDate('date',$this->date)
            ->where('arrival_point_id',$this->arrivalPointId)
            ->where('departure_point_id',$this->departurePointId)
            ->where('is_open',1)
            ->get();
        return view('livewire.reservation');
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

    }

    public function findDepartures()
    {
        $this->selectedDeparture = null;
        $this->departures = Departure::with(['schedule'])->whereDate('date',$this->date)
            ->where('arrival_point_id',$this->arrivalPointId)
            ->where('departure_point_id',$this->departurePointId)
            ->where('is_open',1)
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
        $this->isNew= false;
    }

    public function getDeparture($departureId)
    {
        $this->resetReservationForm();
        $this->selectedReservation = null;
        $this->selectedDepartureId = $departureId;
        $this->selectedDeparture = Departure::with(['schedule','tickets'])
            ->where('id',$departureId)->first();
        $this->totalSeats = $this->selectedDeparture->schedule->seats ?? 0;
        $this->driver_id = $this->selectedDeparture->schedule->driver_id ?? 0;
        $this->car_id = $this->selectedDeparture->schedule->car_id ?? 0;
    }

    public function updatedPhone($value)
    {
        if(strlen($this->phone > 4))
        {
            $this->suggestCustomers = Customer::where('phone','like',$this->phone.'%')->limit(5)->get();
        }else{
            $this->suggestCustomers = [];
        }
    }

    public function setCustomer($customerId)
    {
        $this->customer = Customer::find($customerId);
        $this->phone = $this->customer->phone;
        $this->name = $this->customer->name;
        $this->address = $this->customer->address;
        $this->suggestCustomers = null;
    }

    public function sumPrice()
    {
        $this->subTotal = ($this->selectedDeparture->price - ($this->discount->amount ?? 0)) * count($this->selectedSeats);
    }

    public function save()
    {
        $this->validate([
            'phone'=> 'required|min:10',
            'name'=> 'required',
        ]);
        $this->checkExistCustomere();
        $this->createNewReservation();
        $this->createTicket();
    }

    public function payment()
    {
        $this->reservation->tickets()->update(
            [
                'status'=>'paid',
                'payment_at'=> now(),
                'payment_by' => Auth::id(),
            ]
        );

        $this->emit('updateBill');

//        $this->updateCustomerCountReservationFinish();
    }

    public function saveOnly()
    {
        $this->save();
        $this->resetReservationForm();
        $this->isNew = false;
        $this->selectedReservation = $this->reservation;
        $this->emit('saved');
    }

    public function paymentOnly()
    {
        $this->reservation = $this->selectedReservation;
        $this->payment();
        $this->emit('saved');
    }

    public function saveAndPayment()
    {
        $this->save();
        $this->payment();
        $this->resetReservationForm();
        $this->selectedReservation = $this->reservation;

        $this->emit('saved');
    }

    private function checkExistCustomere(): void
    {
        if (!$this->customer) {
            $this->customer = Customer::create([
                'phone' => $this->phone,
                'name' => $this->name,
                'address' => $this->address,
                'count_reservation' => 0,
                'count_reservation_finished' => 0,
            ]);

        }
    }

    private function createNewReservation(): void
    {
        $this->reservation = new \App\Models\Reservation();
        $this->reservation->user_id = Auth::id();
        $this->reservation->customer_id = $this->customer->id;
        $this->reservation->code = CODE_PESSENGER_RESERVATION . Auth::id() . date('ymdHis');
        $this->reservation->save();
        $this->updateCustomerReservationCount();
    }

    private function createTicket(): void
    {
        foreach ($this->selectedSeats as $seat) {
            $ticket = new Ticket();
            $ticket->reservation_id = $this->reservation->id;
            $ticket->phone = $this->customer->phone;
            $ticket->name = $this->customer->name;
            $ticket->seat = $seat;
            $ticket->discount_id = $this->discount->id ?? null;
            $ticket->discount_name = $this->discount->name ?? null;
            $ticket->discount_amount = $this->discount->amount ?? 0;
            $ticket->price = $this->selectedDeparture->price - ($this->discount->amount ?? 0);
            $ticket->departure_id = $this->selectedDeparture->id;
            $ticket->reservation_by = Auth::id();
            $ticket->reservation_at = now();
            $ticket->status = 'unpaid';
            $ticket->save();
        }
    }

    private function resetReservationForm(): void
    {
        $this->customer = null;
        $this->phone = null;
        $this->name = null;
        $this->address = null;
        $this->selectedSeats = [];

        $this->discountId = 0;
        $this->setDiscount();
    }

    public function getReservation($reservationId)
    {
        $this->isNew = false;
        $this->selectedReservation = \App\Models\Reservation::find($reservationId);
    }

    private function updateCustomerReservationCount(): void
    {
        $this->customer->count_reservation++;
        $this->customer->save();
    }

    private function updateCustomerCountReservationFinish(): void
    {
        $this->customer->count_reservation_finished++;
        $this->customer->save();
    }

    public function resetReservation()
    {
        $this->isNew = true;
        $this->selectedReservation = null;
    }

    public function cancelReservation()
    {
        $this->selectedReservation->tickets()->update(['is_cancel'=>true]);
        $this->resetReservation();
        $this->emit('saved');
        $this->emit('updateBill');
    }

    public function saveManifest()
    {
        $this->selectedDeparture->schedule()->update(['driver_id'=> $this->driver_id, 'car_id'=> $this->car_id]);
        $this->isManifestForm = false;
    }

    public function updatedSearch($value)
    {
        $this->searchReults = Ticket::where(function ($query){
            $query->where('name','like','%'.$this->search.'%')
                ->orWhere('phone','like','%'.$this->search.'%');
        })->orderBy('id','DESC')->limit(5)->get();
    }

    public function getFromSearch($ticketId)
    {
        $ticket = Ticket::find($ticketId);
        $this->getDeparture($ticket->departure_id);
        $this->getReservation($ticket->reservation_id);
    }
}
