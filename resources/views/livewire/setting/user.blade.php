<div xmlns:wire="http://www.w3.org/1999/xhtml">
    <div class="container bg-white">
        <div class="row mt-4">
            <div class="col-md-12 animate__animated animate__fadeIn animate__fast">
                <h1 class="my-3"><strong>User</strong></h1>
                <p>Kelola daftar pengguna</p>
            </div>
            <div class="col-md-3  animate__animated animate__fadeIn animate__fast">
                @if(!$selectedId)
                    <h4><i class="far fa-fw fa-file text-success"></i> Tambah User</h4>
                    <small class="text-muted">Untuk password user baru adalah <strong>suryashuttle</strong></small>
                @else
                    <h4><i class="far fa-fw fa-edit text-primary"></i> Edit {{$code}}</h4>
                @endif
                <form wire:submit.prevent="save">
                    @if (session()->has('message'))
                        <div class="alert alert-success alert-dismissible animate__animated animate__bounceIn fade" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                <span class="sr-only">Close</span>
                            </button>
                            {{ session('message') }}

                        </div>
                    @endif
                    <div class="form-group">
                        <label class="sr-only">ID</label>
                        <input type="text" wire:model="selectedId" class="form-control form-control-lg" readonly placeholder="ID">
                    </div>

                    <div class="form-group">
                        <label class="sr-only">Nama</label>
                        <input type="text" wire:model="name" class="form-control form-control-lg" required placeholder="Nama">
                    </div>
                    <div class="form-group">
                        <label class="sr-only">Email</label>
                        <input type="email" wire:model="email" class="form-control form-control-lg" required placeholder="Email">
                    </div>
                    <div class="form-group">
                        <label class="sr-only">No Handphone</label>
                        <input type="number" wire:model="phone" class="form-control form-control-lg" required placeholder="No. handphone">
                    </div>

                    <div class="form-group">
                        <label class="sr-only">Role</label>
                        <select class="form-control form-control-lg" wire:model="role">
                            <option value="">Pilih Role</option>
                            @forelse($roles as $role)
                                <option value="{{$role->name}}">{{$role->name}}</option>
                            @empty

                            @endforelse

                        </select>
                    </div>

                    <div class="form-group">
                        <label class="sr-only">Point</label>
                        <select class="form-control form-control-lg" wire:model="point_id">
                            <option value="">Pilih Point</option>
                            @forelse($cities as $city)
                                <optgroup label="[{{$city->code}}] {{$city->name}}">
                                    @forelse($city->points as $point)
                                        <option value="{{$point->id}}">[{{$point->code}}] {{$point->name}}</option>
                                    @empty

                                    @endforelse
                                </optgroup>
                            @empty

                            @endforelse
                        </select>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-lg">Simpan</button>
                        <button type="button" class="btn btn-danger btn-lg" wire:click="resetForm">Batalkan</button>
                    </div>
                </form>
            </div>

            <div class="col-md-9 animate__animated animate__fadeIn animate__fast">
                <h4><i class="far fa-fw fa-list-alt text-primary"></i>  Daftar User</h4>
                <table class="table">
                    <thead class="thead-light">
                    <tr>
                        <th width="50rem">ID</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>No. Handphone</th>
                        <th>Role</th>
                        <th>Point</th>
                        <th width="50rem"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($users as $user)
                        <tr>
                            <td>{{$user->id}}</td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->phone}}</td>
                            <td>{{$user->roles[0]->name ?? '-'}}</td>
                            <td>{{$user->point->name ?? '-'}}</td>
                            <td>
                                <button class="btn btn-sm btn-primary" title="Edit" wire:click="get({{$user->id}})"><i class="far fa-edit"></i></button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
