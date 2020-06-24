<div xmlns:wire="http://www.w3.org/1999/xhtml">
    <div class="container bg-white">
        <div class="row mt-4">
            <div class="col-md-12 animate__animated animate__fadeIn animate__fast">
                <h1 class="my-3"><strong>Setting</strong> . Role Access Mangement</h1>
                <p>Kelola hak akses berdasarkan masing-masing role</p>
            </div>

            <div class="col-md-4">
                <h4>Role</h4>
                <select class="form-control form-control-lg" wire:model="roleId" wire:change="setRole()">
                    <option value="0">Pilih Role</option>
                    @forelse($roles as $role)
                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                    @empty

                    @endforelse
                </select>
            </div>

            <div class="col-md-6">
                <h4>Akses</h4>
                @isset($rolePermissions)
                @endisset
                <ul class="list-group">
                    @forelse($permissions as $permission)
                        <li class="list-group-item list-group-item-action" wire:click="togglePermission({{ $permission }})">
                            <label>
                                <input type="checkbox" @if(in_array($permission->name, $rolePermissions)) checked @else  @endif>
                                {{ $permission->name }}
                            </label>
                        </li>
                    @empty

                    @endforelse
                </ul>
            </div>
        </div>
    </div>
</div>
