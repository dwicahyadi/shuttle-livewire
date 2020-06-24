<?php

namespace App\Http\Livewire;

use App\Helpers\SmsHelper;
use Livewire\Component;

class Dashboard extends Component
{
    public $creditSms;

    public function mount()
    {

    }
    public function render()
    {
        return view('livewire.dashboard');
    }
}
