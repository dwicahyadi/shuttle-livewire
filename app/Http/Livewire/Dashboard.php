<?php

namespace App\Http\Livewire;

use App\Helpers\SmsHelper;
use Livewire\Component;

class Dashboard extends Component
{
    public $creditSms;
    public $month;

    public function mount()
    {
        $this->month = date('m');
    }

    public function render()
    {
        return view('livewire.dashboard');
    }
}
