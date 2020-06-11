<?php

namespace App\Http\Livewire\History;

use App\Models\Ticket;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class Transaction extends Component
{
    use WithPagination;
    public $search;

    protected $updatesQueryString = ['search' => ['except' => ''],
        'page' => ['except' => 1],];

    public function mount()
    {
        $this->search = request()->query('search', $this->search);
    }

    public function render()
    {
        $transactions = Ticket::where(function ($query){
            $query->where('name','like','%'.$this->search.'%')
                ->orWhere('phone','like','%'.$this->search.'%');
        })->where('payment_by', Auth::id())->orderBy('id','DESC')->paginate(5);
        return view('livewire.history.transaction',['transactions'=>$transactions]);
    }
}
