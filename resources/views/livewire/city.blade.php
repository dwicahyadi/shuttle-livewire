<div xmlns:wire="http://www.w3.org/1999/xhtml">
    <div class="container bg-white">
        <div class="row mt-4">
            <div class="col-md-12 animate__animated animate__fadeIn animate__fast">
                <h1 class="my-3"><strong>Kota</strong></h1>
                <p>Kelola data Kota</p>
            </div>
            <div class="col-md-3 border-right animate__animated animate__fadeIn">
                @if(!$selectedId)
                    <h4><i class="far fa-fw fa-file text-success"></i> Tambah Kota</h4>
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
                        <label class="sr-only">Kode Kota</label>
                        <input type="text" wire:model="code" class="form-control form-control-lg" maxlength="3" required placeholder="Kode Kota">
                        <small id="helpId" class="text-muted">Maksimal 3 huruf</small>
                    </div>
                    <div class="form-group">
                        <label class="sr-only">Kode Kota</label>
                        <input type="text" wire:model="name" class="form-control form-control-lg" required placeholder="Nama Kota">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-lg">Simpan</button>
                        <button type="button" class="btn btn-danger btn-lg" wire:click="resetForm">Batalkan</button>
                    </div>
                </form>
            </div>

            <div class="col-md-9 animate__animated animate__fadeIn">
                <h4><i class="far fa-fw fa-list-alt text-primary"></i>  Daftar Kota</h4>
                <table class="table">
                    <thead class="thead-light">
                    <tr>
                        <th width="50rem">ID</th>
                        <th>Kode</th>
                        <th>Kota</th>
                        <th width="50rem"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($cities as $city)
                        <tr>
                            <td>{{$city->id}}</td>
                            <td>{{$city->code}}</td>
                            <td>{{$city->name}}</td>
                            <td>
                                <button class="btn btn-sm btn-primary" title="Edit" wire:click="get({{$city->id}})"><i class="far fa-edit"></i></button>
                            </td>
                        </tr>
                    @empty
                        <tr>
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
