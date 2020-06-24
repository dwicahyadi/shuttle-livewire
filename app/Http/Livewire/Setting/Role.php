<?php

namespace App\Http\Livewire\Setting;

use Livewire\Component;

class Role extends Component
{
    public $roles, $roleId, $role, $rolePermissions, $permissions;

    protected $listeners = [ 'saved' => '$refresh'];

    public function mount()
    {
        $this->roles = \Spatie\Permission\Models\Role::all();
        $this->permissions = \Spatie\Permission\Models\Permission::all();
        $this->rolePermissions = [];
    }

    public function render()
    {
        return view('livewire.setting.role');
    }

    public function setRole()
    {
        if ($this->roleId > 0)
        {
            $this->rolePermissions = [];
            $this->role = \Spatie\Permission\Models\Role::findById($this->roleId);
            foreach ($this->role->permissions as $permission)
            {
                array_push($this->rolePermissions, $permission->name);
            }
//            $this->rolePermissions = array_values($this->rolePermissions);
        }else{
            $this->rolePermissions = [];
        }

        $this->emit('saved');
    }

    public function togglePermission($permission)
    {
        if($this->role->hasPermissionTo($permission['name']))
        {
            $this->role->revokePermissionTo($permission['name']);
        }else{
            $this->role->givePermissionTo($permission['name']);
        }

        $this->emit('saved');
    }
}
