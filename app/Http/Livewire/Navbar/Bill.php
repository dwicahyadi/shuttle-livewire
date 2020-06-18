<?php

namespace App\Http\Livewire\Navbar;

use App\Helpers\BillHelper;
use Livewire\Component;

class Bill extends Component
{
    protected $listeners = ['updateBill'];
    public function render()
    {
        return view('livewire.navbar.bill');
    }

    public function updateBill()
    {
        session(['bill' => BillHelper::countBill()]);
    }
}
