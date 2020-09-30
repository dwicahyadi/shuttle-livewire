<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\Customer;
use App\Models\SummaryReport;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;

class CustomerStats extends Component
{
    public $month, $total, $new;

    public function mount($month)
    {
        $this->month = $month;
    }

    public function render()
    {
        $expiresAt = Carbon::now()->endOfDay()->addSecond();

        $this->total = Cache::get('stat_total_customer',function(){
            return SummaryReport::whereMonth('date', $this->month)->count();
        }, $expiresAt);

        $this->new = Customer::whereMonth('created_at', $this->month)->count();
        return view('livewire.dashboard.customer-stats');
    }
}
