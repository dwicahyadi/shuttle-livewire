<?php

namespace App\Console\Commands;

use App\Helpers\SmsHelper;
use App\Models\Reservation;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;

class UpdateExpiredReservation extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reservation:updateExpired';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'find and set expired reservations';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $reservations = Reservation::with(['customer'])
            ->where('expired_at','<=', Carbon::now())
            ->whereNull('is_expired')
            ->get();
        if($reservations){
            foreach ($reservations as $reservation) {
                $reservation->update(['is_expired'=>true]);
                SmsHelper::sendMsg($reservation->customer->phone,'Mohon maaf reservasi anda dibatalkan secara otomatis karena belum melakukan pembayran. -SHURYASHUTTLE');
            }
        }
        $this->line($reservations->count().' reservation/s set as expired');
    }
}
