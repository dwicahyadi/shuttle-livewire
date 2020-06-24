<?php

namespace App\Http\Livewire\Setting;

use Livewire\Component;

class User extends Component
{
    public $name, $email, $phone, $point_id, $role, $selectedId;
    public function render()
    {
        return view('livewire.setting.user', [
            'users'=>\App\Models\User::all(),
            'roles'=> \Spatie\Permission\Models\Role::all(),
            'cities'=>\App\Models\City::with(['points'])->get()]);
    }

    public function save()
    {
        if($this->selectedId)
        {
            $user = \App\Models\User::find($this->selectedId);
        }else{
            $user = new \App\Models\User();
            $user->password = bcrypt('suryashuttle');
        }
        $user->name = $this->name;
        $user->email = $this->email;
        $user->phone = $this->phone;
        $user->point_id = $this->point_id;
        $user->save();

        $user->syncRoles($this->role);
        $this->resetForm();
        session()->flash('message', $this->name.' disimpan.');
    }

    public function get($id)
    {
        $user = \App\Models\User::find($id);
        $this->selectedId = $user->id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->phone = $user->phone;
        $this->point_id = $user->point_id;
        $this->role = $user->roles[0]->name ?? '';
    }

    public function resetForm()
    {
        $this->selectedId = '';
        $this->name = '';
        $this->email = '';
        $this->phone = '';
        $this->point_id = '';
        $this->role = '';
    }
}
