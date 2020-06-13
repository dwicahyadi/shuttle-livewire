<?php

namespace App\Http\Livewire;

use App\Models\Ticket;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class Settlement extends Component
{
    use WithPagination;
    public $transactions;
    public $amount,$note;


    public function render()
    {
        $this->transactions = Ticket::where('payment_by', Auth::id())
            ->whereNull('settlement_id')->orderBy('id','DESC')->get();

        return view('livewire.settlement',['transactions'=>$this->transactions]);
    }

    public function save()
    {
        $settlement = \App\Models\Settlement::create(
            [
                'amount'=> $this->transactions->sum('price'),
                'note' => $this->note,
                'user_id' => Auth::id()
            ]
        );

        Ticket::where('payment_by', Auth::id())->update(['settlement_id'=> $settlement->id]);

    }
}
