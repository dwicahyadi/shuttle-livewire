<?php

namespace App\Http\Livewire\Reservation\Partial;

use App\Helpers\SmsHelper;
use App\Jobs\SendSms;
use App\Models\Customer;
use App\Models\Departure;
use App\Models\Discount;
use App\Models\Ticket;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class NewForm extends Component
{
    public $discounts,$phone, $name, $address, $departureId, $subTotal, $isTransfer, $expire, $uniqueNumber, $discountId;
    public $selectedSeats = [];
    public $suggestCustomers, $isEditCustomer = false;
    public $customer, $departure;

    public $reservation;
    public  $selectedTickets;

    protected $listeners = [
        'selectedSeats'
    ];

    public function mount($departureId)
    {
        $this->discounts = Discount::where('active', true)->get()->keyBy('id');
        $this->departure = Departure::find($departureId);
    }

    public function render()
    {
        return view('livewire.reservation.partial.new-form');
    }

    public function selectedSeats($selectedSeats)
    {
        $this->selectedSeats = $selectedSeats;
        $this->sumPrice();
    }

    public function updatedPhone($value)
    {
        if (strlen($this->phone > 4)) {
            $this->suggestCustomers = Customer::where('phone', 'like', $this->phone . '%')->limit(3)->get();
        } else {
            $this->suggestCustomers = [];
        }
    }

    public function setCustomer($customerId)
    {
        $this->customer = Customer::find($customerId);
        if ($this->customer) {
            $this->phone = $this->customer->phone;
            $this->name = $this->customer->name;
            $this->address = $this->customer->address;
        }
        $this->suggestCustomers = null;
    }

    public function updateCustomer()
    {
        $this->customer->name = $this->name;
        $this->customer->address = $this->address;
        $this->customer->save();
        $isEditCustomer = 0;
    }

    public function sumPrice()
    {
        $this->subTotal = ($this->departure->price - ($this->discounts[$this->discountId]->amount ?? 0))
            * count($this->selectedSeats);
    }

    public function save()
    {
        $this->validate([
            'phone' => 'required|min:10',
            'name' => 'required',
        ]);
        $this->checkExistCustomer();
        $this->createNewReservation();
        $this->createTicket();
        SmsHelper::generateMsg($this->reservation->id);
    }

    public function payment()
    {
        $this->reservation->update(['expired_at'=> null,'is_expired'=>false]);
        $this->reservation->tickets()->update(
            [
                'status' => 'paid',
                'payment_method' => $this->paymentMethod,
                'payment_at' => now(),
                'payment_by' => Auth::id(),
            ]
        );

        dispatch(new SendSms(['phone'=>$this->reservation->customer->phone, 'message'=>'Terimakasih. Pembayaran berhasil dilakukan']));

        $this->emit('updateBill');
        $this->updateCustomerCountReservationFinish();
    }

    public function saveOnly()
    {
        $this->save();
        $this->resetReservationForm();
//        $this->isNew = false;
//        $this->getDeparture($this->selectedDepartureId);
        $this->emit('saved');
    }

    public function paymentOnly()
    {
        $this->payment();
        $this->emit('saved');
    }

    public function saveAndPayment()
    {
        $this->save();
        $this->payment();
        $this->resetReservationForm();
        $this->getDeparture($this->selectedDepartureId);
        $this->emit('saved');
    }

    private function checkExistCustomer(): void
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
        $this->reservation->expired_at = $this->expire;
        if($this->uniqueNumber) $this->reservation->transfer_amount = $this->subTotal + $this->uniqueNumber;
        $this->reservation->save();
        $this->updateCustomerReservationCount();
    }

    private function createTicket(): void
    {
        foreach ($this->selectedSeats as $seat) {
            $ticket = new Ticket();
            $ticket->reservation_id = $this->reservation->id;
            $ticket->departure_point_id = $this->departure->departurePointId;
            $ticket->arrival_point_id = $this->departure->arrivalPointId;
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
            $ticket->count_print = 0;
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
        $this->paymentMethod = 'CASH PAYMENT';

        $this->discountId = 0;
    }

}
