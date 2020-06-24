<div xmlns:wire="http://www.w3.org/1999/xhtml">
    <div class="container bg-white">
        <div class="row mt-4">
            <div class="col-md-12 animate__animated animate__fadeIn animate__fast">
                <h1 class="my-3"><strong>Profile</strong></h1>
                <p>Kelola daftar pengguna</p>
                @if (session()->has('message'))
                    <div class="alert alert-success alert-dismissible animate__animated animate__bounceIn fade" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        {{ session('message') }}
                    </div>
                @endif
            </div>

            <div class="col-md-6">
                <div class="card my-2">
                    <div class="card-body">
                        <form wire:submit.prevent="save">
                            <h4>Personal</h4>
                            <div class="form-group">
                                <label>ID</label>
                                <input type="text" wire:model="selectedId" class="form-control form-control-lg" readonly placeholder="ID">
                            </div>

                            <div class="form-group">
                                <label>Nama</label>
                                <input type="text" wire:model="name" class="form-control form-control-lg" required placeholder="Nama">
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" wire:model="email" class="form-control form-control-lg" required placeholder="Email">
                            </div>
                            <div class="form-group">
                                <label>No Handphone</label>
                                <input type="number" wire:model="phone" class="form-control form-control-lg" required placeholder="No. handphone">
                            </div>
                            <hr>
                            <h4>Posisi</h4>
                            <div class="form-group">
                                <label>Role</label>
                                <input type="text" wire:model="role" class="form-control form-control-lg" readonly placeholder="role">
                            </div>

                            <div class="form-group">
                                <label>Point</label>
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

                            <hr>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-lg">Simpan</button>
                                <button type="button" class="btn btn-danger btn-lg" wire:click="resetForm">Batalkan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card my-2">
                    <div class="card-body">
                        <form wire:submit.prevent="changePassword">
                            <h4>Ganti Password</h4>
                            <div class="form-group" wire:model="oldPassword">
                                <label>Password Lama</label>
                                <input type="password" class="form-control form-control-lg">
                            </div>

                            <div class="form-group" wire:model="newPassword">
                                <label>Password Baru</label>
                                <input type="password" class="form-control form-control-lg">
                            </div>

                            <div class="form-group" wire:model="confirmNewPassword">
                                <label>Ulangi Password Baru</label>
                                <input type="password" class="form-control form-control-lg">
                                <span class="text-danger">{{ $confirm }}</span>
                            </div>


                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-lg">Ganti Password</button>
                                <button type="button" class="btn btn-danger btn-lg" wire:click="resetForm">Batalkan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
