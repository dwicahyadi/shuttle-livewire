<?php

namespace App\Http\Livewire;

use App\Jobs\SendSms;
use App\Models\Reservation;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class TransferPaymentMonitor extends Component
{
    use WithPagination;
    public $transferAmount;

    protected $updatesQueryString = ['transferAmount' => ['except' => ''],
        'page' => ['except' => 1],];

    public function mount()
    {
        $this->transferAmount = request()->query('search', $this->transferAmount);
    }

    public function render()
    {
        $reservations = Reservation::with(['customer','tickets'])
            ->where('expired_at','>=', Carbon::now())
            ->whereNull('is_expired');
        if ($this->transferAmount) $reservations->where('transfer_amount','=', $this->transferAmount);
        return view('livewire.transfer-payment-monitor',['reservations'=>$reservations->get()]);
    }

    public function payment($reservationId)
    {
        $reservation = Reservation::find($reservationId);
        $reservation->update(['expired_at'=> null,'is_expired'=>false]);
        $reservation->tickets()->update(
            [
                'status' => 'paid',
                'payment_method' => 'BANK TRANSFER',
                'payment_at' => now(),
                'payment_by' => Auth::id(),
            ]
        );

        dispatch(new SendSms(['phone'=>$reservation->customer->phone, 'message'=>'Terimakasih. Pembayaran via transfer berhasil dilakukan. Silakan datang maks 10 mnt sblm kbrgktn. -SURYASHUTTLE']));

        $this->emit('updateBill');
        $reservation->customer->count_reservation_finished = $reservation->customer->count_reservation_finished++;
        $reservation->customer->save();
    }
}
