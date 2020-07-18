<?php

namespace App\Http\Livewire\Partial;

use Livewire\Component;

class PackageList extends Component
{
    public $name;
    public function render()
    {
        return view('livewire.partial.package-list');
    }
}
