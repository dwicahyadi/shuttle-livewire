<div xmlns:wire="http://www.w3.org/1999/xhtml">
    <div class="container">
        <div class="row mt-4">
            <div class="col-md-12 animate__animated animate__fadeIn animate__fast">
                <h1 class="my-3"><strong>Mobil</strong></h1>
                <p>Kelola daftar unit mobil</p>
            </div>
            <div class="col-md-6  animate__animated animate__fadeIn animate__fast">
                @if(!$selectedId)
                    <h4><i class="far fa-fw fa-file text-success"></i> Tambah Mobil</h4>
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
                        <label class="sr-only">Kode Unit</label>
                        <input type="text" wire:model="code" class="form-control form-control-lg"  required placeholder="Kode Unit">
                        <small id="helpId" class="text-muted">Maksimal 10 huruf</small>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-lg">Simpan</button>
                        <button type="button" class="btn btn-danger btn-lg" wire:click="resetForm">Batalkan</button>
                    </div>
                </form>
            </div>

            <div class="col-md-6 animate__animated animate__fadeIn animate__fast">
                <h4><i class="far fa-fw fa-list-alt text-primary"></i>  Daftar Mobil</h4>
                <table class="table">
                    <thead class="thead-light">
                    <tr>
                        <th width="50rem">ID</th>
                        <th>Kode Unit</th>
                        <th>Nomor Polisi</th>
                        <th>Kilometer Terkhir</th>
                        <th>Aktif</th>
                        <th width="50rem"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($cars as $car)
                        <tr>
                            <td>{{$car->id}}</td>
                            <td>{{$car->code}}</td>
                            <td>{{$car->license_number}}</td>
                            <td align="right">{{number_format($car->kilometers)}}</td>
                            <td>{{$car->active}}</td>
                            <td>
                                <button class="btn btn-sm btn-primary" title="Edit" wire:click="get({{$car->id}})"><i class="far fa-edit"></i></button>
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