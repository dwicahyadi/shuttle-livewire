<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Discount extends Component
{
    public $code, $name, $amount, $active, $selectedId;

    public function render()
    {
        return view('livewire.discount',['discounts'=>\App\Models\Discount::all()]);
    }

    public function save()
    {
        $discount = $this->selectedId ? \App\Models\Discount::find($this->selectedId) : new \App\Models\Discount();
        $discount->code = $this->code;
        $discount->name = $this->name;
        $discount->amount = $this->amount;
        $discount->active = $this->active ?? true;
        $discount->save();
        session()->flash('message', $this->name.' disimpan.');
        $this->resetForm();
    }

    public function get($id)
    {
        $discount = \App\Models\Discount::find($id);
        $this->selectedId = $discount->id;
        $this->code = $discount->code;
        $this->name = $discount->name;
        $this->amount = $discount->amount;
        $this->active = $discount->active;
    }

    public function resetForm()
    {
        $this->selectedId = null;
        $this->code = '';
        $this->name = '';
        $this->amount = 0;
        $this->active = true;
    }

    public function toggleAvtive($id)
    {
        $discount = \App\Models\Discount::find($id);
        $discount->active = !$discount->active;
        $discount->save();
    }
}

