<div>
    <div class="shadow-sm sticky-top p-2 bg-white border-top" style="height: 4rem;">
        <div class="d-flex w-100 mx-auto justify-content-between">
            <button type="button" class="btn btn-sm" data-toggle="modal" data-target="#confirmManifest">
                <img src="{{ asset('images/check.svg') }}" alt="new" width="18">
                <br> Simpan
            </button>

            <button type="button" class="btn btn-sm" title="Refresh" wire:click="$refresh">
                <img src="{{ asset('images/pay.svg') }}" alt="new" width="18">
                <br> Bayar
            </button>
        </div>
    </div>
    <form onsubmit="return false" class="p-2">
        <div class="row">
            <div class="form-group col-6">
                <label>Nomor Handphone</label>
                <input type="text" wire:model="phone" class="form-control" required>
                <span class="text-danger">@error('phone')
                    {{ $message }}
                    @enderror</span>
                @if($suggestCustomers)

                    <ul class="list-group position-absolute w-100 shadow">
                        @foreach($suggestCustomers as $suggestCustomer)
                            <li class="list-group-item list-group-item-action" wire:click="setCustomer({{$suggestCustomer->id}})">
                                <small>{!! str_replace($phone,'<span class="bg-warning">'.$phone.'</span>',$suggestCustomer->phone) !!}</small>
                                <p class="m-1">{{$suggestCustomer->name}}</p>
                                <span class="text-info"><i class="fa fa-info-circle"></i> {{$suggestCustomer->count_reservation_finished}} dari {{$suggestCustomer->count_reservation}} reservasi diselesaikan</span>

                            </li>
                        @endforeach
                        @if(count($suggestCustomers)> 1)
                            <li class="list-group-item list-group-item-action" wire:click="setCustomer(0)">
                                <small>Tutup Daftar</small>
                            </li>
                        @endif
                    </ul>
                @endif
            </div>
            <div class="form-group col-6">
                <label>Nama</label>
                <input type="text" wire:model="name"  class="form-control" required @if($customer)
                readonly
                    @endif>
                <span class="text-danger">@error('name')
                    {{ $message }}
                    @enderror</span>
            </div>
        </div>
        <div class="form-group">
            <div class="d-flex justify-content-between">
                <label>Alamat</label>
                @if($customer)
                    <a wire:click="$set('isEditCustomer',1)" class="text-primary">Klik untuk update data Customer</a>
                @endif

            </div>
            <input type="text" wire:model="address" class="form-control" @if($customer)
            readonly
                @endif>
        </div>

        <div class="form-group">
            <label>Harga</label>
            <select class="form-control" wire:model="discountId" wire:change="sumPrice">
                @forelse($discounts as $discount_)
                    <option value="{{ $discount_->id }}">{{ $discount_->name}} Rp.{{ number_format($departure->price - $discount_->amount) }}</option>
                @empty

                @endforelse
                <option value="">Umum Rp.{{ number_format($departure->price ?? 0)  }}</option>
            </select>
            <label class="my-2"><input type="checkbox" wire:click="toggleTransfer"> Pembayaran melalui Transfer</label>
            @if($expire)
                <div class="my-2 p-1 bg-warning">
                    Maksimal waktu transfer adalah <strong>{{ $expire }}</strong> atau reservasi akan dibatalkan secara otomatis.
                </div>
            @endif
        </div>

        <div class="form-group">
            <label>Kursi</label>
            <table class="table table-borderless">
                @foreach($selectedSeats as $seat)
                    <tr class="border-bottom">
                        <td style="width: 20rem">
                            <h5><strong>Seat {{ $seat }}</strong></h5>
                        </td>

                        <td align="right">
                            <small class="text-muted">{{ $discount->name ?? 'Umum' }}</small>
                            <h5><small>Rp.</small>{{number_format($departure->price - ($discount->amount ?? 0))}}</h5>
                        </td>
                    </tr>
                @endforeach
                <tr>
                    <td colspan=""></td>
                    <td align="right"><h4><small>Rp.</small>{{ number_format($subTotal )}} {{ $uniqueNumber ? '+'.$uniqueNumber : '' }}</h4></td>
                </tr>

            </table>
        </div>

        <div class="form-group">

        </div>

        <hr>
    </form>

    @if($isEditCustomer)
        <div class="modal d-block" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-sm">
                <div class="modal-content shadow-lg">
                    <div class="modal-header">
                        <h4 class="modal-title">Edit Customer</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" wire:click="$set('isEditCustomer',0)">×</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Handphone</label>
                            <input type="text" wire:model="phone"  class="form-control" readonly>
                            <span class="text-danger">@error('phone')
                                {{ $message }}
                                @enderror</span>
                        </div>

                        <div class="form-group">
                            <label>Nama</label>
                            <input type="text" wire:model="name"  class="form-control">
                        </div>

                        <div class="form-group">
                            <label>Nama</label>
                            <input type="text" wire:model="address"  class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" wire:click="$set('isEditCustomer',0)">Close</button>
                        <button type="button" class="btn btn-primary" wire:click="updateCustomer" >Update</button>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
