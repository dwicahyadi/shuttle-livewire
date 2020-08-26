<?php

namespace App\Http\Livewire;

use App\Helpers\BillHelper;
use App\Helpers\SmsHelper;
use App\Jobs\SendSms;
use App\Models\Car;
use App\Models\City;
use App\Models\Customer;
use App\Models\Departure;
use App\Models\Discount;
use App\Models\Driver;
use App\Models\Point;
use App\Models\Schedule;
use App\Models\Ticket;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

define('CODE_PESSENGER_RESERVATION', 'PSG');

class Reservation extends Component
{
   public function render()
   {
       return view('livewire.reservation');
   }
}
