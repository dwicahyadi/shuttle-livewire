<div xmlns:wire="http://www.w3.org/1999/xhtml">
    <div class="container bg-white">
        <div class="row mt-4">
            <div class="col-md-12 animate__animated animate__fadeIn animate__fast">
                <h1 class="my-3"><strong>Discount</strong></h1>
                <p>Kelola daftar unit discount/promo</p>
            </div>
            <div class="col-md-3  animate__animated animate__fadeIn animate__fast">
                @if(!$selectedId)
                    <h4><i class="far fa-fw fa-file text-success"></i> Tambah Discount</h4>
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
                        <label class="sr-only">Kode</label>
                        <input type="text" wire:model="code" class="form-control form-control-lg" maxlength="10" required placeholder="Kode">
                        <small id="helpId" class="text-muted">Maksimal 10 huruf</small>
                    </div>
                    <div class="form-group">
                        <label class="sr-only">Nama Diskon</label>
                        <input type="text" wire:model="name" class="form-control form-control-lg" required placeholder="Nama Diskon">
                    </div>
                    <div class="form-group">
                        <label class="sr-only">Besar Diskon</label>
                        <input type="number" wire:model="amount" class="form-control form-control-lg" required placeholder="Besar Diskon">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-lg">Simpan</button>
                        <button type="button" class="btn btn-danger btn-lg" wire:click="resetForm">Batalkan</button>
                    </div>
                </form>
            </div>

            <div class="col-md-9 animate__animated animate__fadeIn animate__fast">
                <h4><i class="far fa-fw fa-list-alt text-primary"></i>  Daftar Diskon</h4>
                <table class="table">
                    <thead class="thead-light">
                    <tr>
                        <th width="50rem">ID</th>
                        <th>Kode</th>
                        <th>Nama Dsikon</th>
                        <th>Besar Diskon</th>
                        <th>Aktif</th>
                        <th width="50rem"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($discounts as $discount)
                        <tr>
                            <td>{{$discount->id}}</td>
                            <td>{{$discount->code}}</td>
                            <td>{{$discount->name}}</td>
                            <td align="right">{{number_format($discount->amount)}}</td>
                            <td>@if($discount->active)
                                    <button type="button" class="btn btn-sm btn-success" wire:click="toggleAvtive({{$discount->id}})">Active</button>
                                @else
                                    <button type="button" class="btn btn-sm btn-danger" wire:click="toggleAvtive({{$discount->id}})">Inactive</button>
                                @endif
                            </td>
                            <td>
                                <button class="btn btn-sm btn-primary" title="Edit" wire:click="get({{$discount->id}})"><i class="far fa-edit"></i></button>
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
