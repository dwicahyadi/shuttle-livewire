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
            <option value="">Umum Rp.{{ number_format($selectedDeparture->price ?? 0)  }}</option>
            @forelse($discounts as $discount_)
                <option value="{{ $discount_->id }}">{{ $discount_->name}} Rp.{{ number_format($selectedDeparture->price - $discount_->amount) }}</option>
            @empty

            @endforelse
        </select>
    </div>

    <div class="form-group">
        <label>Kursi</label>
        <table class="table table-borderless">
            @foreach($selectedSeats as $seat)
                <tr class="border-bottom">
                    <td style="width: 20rem">
                        <h3><strong>Seat {{ $seat }}</strong></h3>
                    </td>

                    <td align="right">
                        <small class="text-muted">{{ $discount->name ?? 'Umum' }}</small>
                        <h4><small>Rp.</small>{{number_format($selectedDeparture->price - ($discount->amount ?? 0))}}</h4>
                    </td>
                </tr>
            @endforeach
            <tr>
                <td colspan=""></td>
                <td align="right"><h3><small>Rp.</small>{{ number_format($subTotal )}}</h3></td>
            </tr>

        </table>
    </div>

    <hr>
</form>
