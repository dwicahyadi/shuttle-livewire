<?php

namespace App\Http\Livewire\History;

use App\Models\Ticket;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class Settlement extends Component
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
        $settlements = Auth::user()->settlements()->orderBy('id','desc')->paginate(5);

        return view('livewire.history.settlement',['settlements'=>$settlements]);
    }
}
