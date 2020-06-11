<?php

namespace App\Http\Livewire;

use Livewire\Component;

class City extends Component
{
    public $code, $name, $selectedId;

    public function render()
    {
        return view('livewire.city',['cities'=>\App\Models\City::all()]);
    }

    public function save()
    {
        $city = $this->selectedId ? \App\Models\City::find($this->selectedId) : new \App\Models\City();
        $city->code = $this->code;
        $city->name = $this->name;
        $city->save();
        session()->flash('message', $this->name.' disimpan.');
        $this->resetForm();
    }

    public function get($id)
    {
        $city = \App\Models\City::find($id);
        $this->selectedId = $city->id;
        $this->code = $city->code;
        $this->name = $city->name;
    }

    public function resetForm()
    {
        $this->selectedId = null;
        $this->code = '';
        $this->name = '';
    }
}
