<div xmlns:wire="http://www.w3.org/1999/xhtml">
    <div class="row mt-4">
        <div class="col-md-12 animate__animated animate__fadeIn animate__fast">
            <h1 class="my-3"><strong>Point</strong></h1>
            <p>Kelola data Point keberangkatan dan tujuan</p>
        </div>
        <div class="col-md-3  animate__animated animate__fadeIn animate__fast">
            @if(!$selectedId)
                <h4><i class="far fa-fw fa-file text-success"></i> Tambah Point</h4>
            @else
                <h4><i class="far fa-fw fa-edit text-primary"></i> Edit {{$name}}</h4>
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
                    <label class="sr-only">Kota</label>
                    <select wire:model="cityId" class="form-control form-control-lg">
                        <option value="">Pilih Kota</option>
                        @forelse($cities as $city)
                            <option value="{{$city->id}}">{{$city->name}}</option>
                        @empty

                        @endforelse
                    </select>
                </div>
                <div class="form-group">
                    <label class="sr-only">Kode Point</label>
                    <input type="text" wire:model="code" class="form-control form-control-lg" maxlength="3" required placeholder="Kode Point">
                    <small id="helpId" class="text-muted">Maksimal 3 huruf</small>
                </div>
                <div class="form-group">
                    <label class="sr-only">Nama Point</label>
                    <input type="text" wire:model="name" class="form-control form-control-lg" required placeholder="Nama Point">
                </div>
                <div class="form-group">
                    <label class="sr-only">Alamat</label>
                    <textarea wire:model="address" class="form-control form-control-lg" placeholder="Alamat (opsional)"></textarea>
                </div>
                <div class="form-group">
                    <label class="sr-only">Telp</label>
                    <input type="text" wire:model="phone" class="form-control form-control-lg" placeholder="Telepon (opsional)">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg">Simpan</button>
                    <button type="button" class="btn btn-danger btn-lg" wire:click="resetForm">Batalkan</button>
                </div>
            </form>
        </div>

        <div class="col-md-9 animate__animated animate__fadeIn animate__fast">
            <h4><i class="far fa-fw fa-list-alt text-primary"></i>  Daftar Point</h4>
            <table class="table">
                <thead class="thead-light">
                <tr>
                    <th width="50rem">ID</th>
                    <th>Kota</th>
                    <th>Kode</th>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>Telepon</th>
                    <th>Aktif</th>
                    <th width="50rem"></th>
                </tr>
                </thead>
                <tbody>
                @forelse($points as $point)
                    <tr>
                        <td>{{$point->id}}</td>
                        <td>{{$point->city->name}}</td>
                        <td>{{$point->code}}</td>
                        <td>{{$point->name}}</td>
                        <td>{{$point->address}}</td>
                        <td>{{$point->phone}}</td>
                        <td>{{$point->active}}</td>
                        <td>
                            <button class="btn btn-sm btn-primary" title="Edit" wire:click="get({{$point->id}})"><i class="far fa-edit"></i></button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td></td>
                        <td></td>
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
