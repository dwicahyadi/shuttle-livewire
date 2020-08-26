<div>
    <form onsubmit="return false" class="p-2">
        <div class="row">
            <div class="form-group col-6">
                <label>Nomor Handphone</label>
                <input type="text" wire:model="phone" class="form-control" required>
                <span class="text-danger">
                                    @error('phone')
                    {{ $message }}
                    @enderror</span>
                @if(isset($suggestCustomers))
                    <ul class="list-group position-absolute w-100 shadow">
                        @foreach($suggestCustomers as $suggestCustomer)
                            <li class="list-group-item list-group-item-action" wire:click="setCustomer({{$suggestCustomer->id}})">
                                <small>{!! str_replace($phone,'<span class="bg-warning">'.$phone.'</span>',$suggestCustomer->phone) !!}</small>
                                <p class="m-1">{{$suggestCustomer->name}}</p>
                                <span class="text-info"><i class="fa fa-info-circle"></i> {{$suggestCustomer->count_reservation_finished}} dari {{$suggestCustomer->count_reservation}} reservasi diselesaikan</span>

                            </li>
                        @endforeach
                        <li class="list-group-item list-group-item-action" wire:click="setCustomer(0)">
                            <small>Tutup Daftar</small>
                        </li>
                    </ul>
                @endif
            </div>
            <div class="form-group col-6">
                <label>Nama</label>
                <input type="text"   class="form-control" required/>
                <span class="text-danger">@error('name')
                    {{ $message }}
                    @enderror</span>
            </div>
        </div>
        <div class="form-group">
            <div class="d-flex justify-content-between">
                <label>Alamat</label>
                {{--@if($customer)
                    <a wire:click="$set('isEditCustomer',1)" class="text-primary">Klik untuk update data Customer</a>
                @endif--}}

            </div>
            <input type="text"  class="form-control">
        </div>

        <div class="form-group">
            <label>Harga</label>

            <label class="my-2"><input type="checkbox" > Pembayaran melalui Transfer</label>

        </div>

        <div class="form-group">
            <label>Kursi</label>

        </div>

        <div class="form-group">

        </div>

        <hr>
    </form>  <!-- The whole future lies in uncertainty: live immediately. - Seneca -->
</div>
