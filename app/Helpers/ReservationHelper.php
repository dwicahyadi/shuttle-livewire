<?php
namespace App\Helpers;


use App\Jobs\SendSms;
use App\Models\Customer;
use App\Models\Departure;
use App\Models\Ticket;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReservationHelper
{
    public function save()
    {
        $this->checkExistCustomere();
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
            $ticket->departure_point_id = $this->departurePointId;
            $ticket->arrival_point_id = $this->arrivalPointId;
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
}
