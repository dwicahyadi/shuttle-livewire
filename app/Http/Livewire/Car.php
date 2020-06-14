<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Car extends Component
{
    public $code, $license_number, $kilometers, $active, $selectedId;

    public function render()
    {
        return view('livewire.car',['cars'=>\App\Models\Car::all()]);
    }

    public function save()
    {
        $car = $this->selectedId ? \App\Models\Car::find($this->selectedId) : new \App\Models\Car();
        $car->code = $this->code;
        $car->license_number = $this->license_number;
        $car->kilometers = $this->kilometers;
        $car->active = $this->active ?? true;
        $car->save();
        session()->flash('message', $this->license_number.' disimpan.');
        $this->resetForm();
    }

    public function get($id)
    {
        $car = \App\Models\Car::find($id);
        $this->selectedId = $car->id;
        $this->code = $car->code;
        $this->license_number = $car->license_number;
        $this->kilometers = $car->kilometers;
        $this->active = $car->active;
    }

    public function resetForm()
    {
        $this->selectedId = null;
        $this->code = '';
        $this->license_number = '';
        $this->kilometers = 0;
        $this->active = true;
    }
}
