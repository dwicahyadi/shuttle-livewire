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

    public $isNew, $isManifestForm;
    public $cities, $discounts, $cars, $drivers;
    public $departurePointId, $arrivalPointId, $date, $departurePoint, $arrivalPoint, $discountId, $discount;

    public $departures, $selectedDepartureId, $selectedDeparture , $selectedReservation;

    public $phone, $name, $address, $departureId;
    public $selectedSeats = [];
    public $suggestCustomers;
    public $customer;

    public $reservation;

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
        $this->date = request('date');
        $this->departurePointId = request('departurePointId');
        $this->arrivalPointId = request('arrivalPointId');
        $this->selectedDepartureId = request('selectedDepartureId');
        $this->setDeparturePoint();
        $this->setArrivalPoint();
        $this->selectedDeparture = Departure::with(['tickets'])
            ->where('id',$this->selectedDepartureId)->first();
    }
    public function render()
    {
        if(!$this->date) $this->date = date('Y-m-d');
        $this->departures = Departure::whereDate('date',$this->date)
            ->where('arrival_point_id',$this->arrivalPointId)
            ->where('departure_point_id',$this->departurePointId)
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
        $this->departures = Departure::whereDate('date',$this->date)
            ->where('arrival_point_id',$this->arrivalPointId)
            ->where('departure_point_id',$this->departurePointId)
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
    }

    public function getDeparture($departureId)
    {
        $this->resetReservationForm();
        $this->selectedReservation = null;
        $this->selectedDepartureId = $departureId;
        $this->selectedDeparture = Departure::with(['tickets'])
            ->where('id',$departureId)->first();
    }

    public function updatedPhone($value)
    {
        if(strlen($this->phone > 4))
        {
            $this->suggestCustomers = Customer::where('phone','like',$this->phone.'%')->get();
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

        session(['bill' => BillHelper::countBill()]);

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
        $this->isNew = false;
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
        $this->selectedReservation = null;
    }

    public function updatingselectedDeparture($value)
    {
        $this->classAnimation = 'animate__zoomOut';
    }

    public function updatedselectedDeparture($value)
    {
        $this->classAnimation = 'animate__zoomIn';
    }


}
