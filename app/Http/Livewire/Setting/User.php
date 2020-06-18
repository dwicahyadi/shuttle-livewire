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
        $user = $this->selectedId ? \App\Models\User()::find($this->selectedId) : new \App\Models\User();
        $user->name = $this->name;
        $user->email = $this->email;
        $user->phone = $this->phone;
        $user->password = bcrypt('suryashuttle');
        $user->point_id = $this->point_id;
        $user->save();

        $user->syncRoles($this->role);
        session()->flash('message', $this->name.' disimpan.');
    }
}
