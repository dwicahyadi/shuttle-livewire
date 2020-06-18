@php($seats = $selectedDeparture->tickets->keyBy('seat'))
<form onsubmit="return false" class="p-2">
    <div class="row">
        <div class="form-group col-6">
            <label>Nomor Handphone</label>
            <input type="text" wire:model="phone" class="form-control" required>
            @if($suggestCustomers)
                <ul class="list-group position-absolute w-100 shadow">
                    @foreach($suggestCustomers as $suggestCustomer)
                        <li class="list-group-item list-group-item-action" wire:click="setCustomer({{$suggestCustomer->id}})">
                            <small>{!! str_replace($phone,'<span class="bg-warning">'.$phone.'</span>',$suggestCustomer->phone) !!}</small>
                            <p class="m-1">{{$suggestCustomer->name}}</p>
                            <span class="text-info"><i class="fa fa-info-circle"></i> {{$suggestCustomer->count_reservation_finished}} dari {{$suggestCustomer->count_reservation}} reservasi diselesaikan</span>

                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
        <div class="form-group col-6">
            <label>Nama</label>
            <input type="text" wire:model="name"  class="form-control" required>
        </div>
    </div>
    <div class="form-group">
        <label>Alamat</label>
        <input type="text" wire:model="address" class="form-control" required>
    </div>

    <div class="form-group">
        <label>Harga</label>
        <select class="form-control" wire:model="discountId" wire:change="setDiscount">
            <option value="">Harga Normal Rp.{{ number_format($selectedDeparture->price ?? 0)  }}</option>
            @forelse($discounts as $discount_)
                <option value="{{ $discount_->id }}">{{ $discount_->name}} Rp.{{ number_format($selectedDeparture->price - $discount_->amount) }}</option>
            @empty

            @endforelse
        </select>
    </div>

    <div class="form-group">
        <label>Kursi Tersedia</label>
        <div class="clearfix">
            @for($i = 1; $i <= $totalSeats; $i++)
                @isset($seats[$i])

                @else
                    <div class="ck-button">
                        <label>
                            <input type="checkbox" value="{{$i}}" wire:model="selectedSeats" wire:change="sumPrice"><span>{{$i}}</span>
                        </label>
                    </div>
                @endisset
            @endfor
        </div>
    </div>

    <div class="form-group text-left">
        <h1 class="text-left"><small>Rp.</small>{{ number_format( $subTotal ) }}</h1>
    </div>
    <hr>
    <div class="form-group text-center">
        <button type="submit" wire:click="saveOnly" class="btn btn-primary btn-lg">Simpan</button>
        <button type="submit"  data-toggle="modal" data-target="#confirmSaveAndPayment"class="btn btn-success btn-lg">Bayar</button>
        <button type="submit"  data-toggle="modal" data-target="#confirmSaveAndPayment"class="btn btn-success btn-lg">Cetak Tiket</button>
    </div>
</form>
