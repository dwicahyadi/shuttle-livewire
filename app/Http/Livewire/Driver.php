<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Driver extends Component
{
    public $name, $address, $phone, $active, $selectedId;

    public function render()
    {
        return view('livewire.driver',[
            'drivers'=>\App\Models\Driver::all(),
        ]);
    }


    public function save()
    {
        $driver = $this->selectedId ? \App\Models\Driver::find($this->selectedId) : new \App\Models\Driver();
        $driver->name = $this->name;
        $driver->address = $this->address;
        $driver->phone = $this->phone;
        $driver->active = $this->active ?? true;
        $driver->save();
        session()->flash('message', $this->name.' disimpan.');
        $this->resetForm();
    }

    public function get($id)
    {
        $driver = \App\Models\Driver::find($id);
        $this->selectedId = $driver->id;
        $this->name = $driver->name;
        $this->address = $driver->address;
        $this->phone = $driver->phone;
        $this->active = $driver->active;
    }

    public function resetForm()
    {
        $this->name = '';
        $this->address = '';
        $this->phone = '';
        $this->active = true;
        $this->selectedId = null;
    }
}

