<?php

namespace App\Http\Livewire;

use Livewire\Component;

class CardStat extends Component
{
    public $stat, $desc;

    public function mount($desc = 'Deskrpsi',$stat = 0)
    {
        $this->desc = $desc;
        $this->stat = $stat;
    }
    public function render()
    {
        return view('livewire.card-stat');
    }
}
