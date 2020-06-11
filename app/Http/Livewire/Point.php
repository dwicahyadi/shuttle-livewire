<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Point extends Component
{
    public $cityId, $code, $name, $address, $phone, $active, $selectedId;

    public function render()
    {
        return view('livewire.point',[
            'cities'=>\App\Models\City::all(),
            'points'=>\App\Models\Point::all(),
        ]);
    }


    public function save()
    {
        $point = $this->selectedId ? \App\Models\Point::find($this->selectedId) : new \App\Models\Point();
        $point->city_id = $this->cityId;
        $point->code = $this->code;
        $point->name = $this->name;
        $point->address = $this->address;
        $point->phone = $this->phone;
        $point->active = $this->active;
        $point->save();
        session()->flash('message', $this->name.' disimpan.');
        $this->resetForm();
    }

    public function get($id)
    {
        $point = \App\Models\Point::find($id);
        $this->selectedId = $point->id;
        $this->cityId = $point->city_id;
        $this->code = $point->code;
        $this->name = $point->name;
        $this->address = $point->address;
        $this->phone = $point->phone;
        $this->active = $point->active;
    }

    public function resetForm()
    {
        $this->cityId = null;
        $this->code = '';
        $this->name = '';
        $this->address = '';
        $this->phone = '';
        $this->active = true;
        $this->selectedId = null;
    }
}
