<div>
    <style>
        .bg-c-blue {
            background:  linear-gradient(45deg,#3490dc, #52BEED);
        }
        .departureTime{
            background-image:  url("{{ asset('images/calendar.svg') }}");
            background-repeat: no-repeat;
            background-size: 2rem 2rem;
            background-position: bottom left;
        }

        .points{
            background-image:  url("{{ asset('images/pin.svg') }}");
            background-repeat: no-repeat;
            background-size: 4rem 4rem;
            background-position: bottom right;
        }

        .clocks{
            background-image:  url("{{ asset('images/clock.svg') }}");
            background-repeat: no-repeat;
            background-size: 4rem 4rem;
            background-position: bottom right;
        }

        .bg-c-green {
            background: linear-gradient(45deg,#2ed8b6,#59e0c5);
        }

        .bg-c-yellow {
            background: linear-gradient(45deg,#FFB64D,#ffcb80);
        }

        .bg-c-pink {
            background: linear-gradient(45deg,#FF5370,#ff869a);
        }
        .form-control{
            max-width: 550px;
        }
        .seat{
            background-image: url('{{ asset('images/seat.svg') }}');
            background-repeat: no-repeat;
            background-position: center;
            background-size: 5rem 5rem;
            height: 10rem;
            position: relative;
        }
        .ck-button {
            margin:4px;
            background-color:#EFEFEF;
            border-radius:4px;
            border:1px solid #D0D0D0;
            overflow:auto;
            float:left;
        }

        .ck-button:hover {
            background:red;
        }

        .ck-button label {
            float:left;
            width:4.0em;
        }

        .ck-button label span {
            text-align:center;
            padding:3px 0px;
            display:block;
        }

        .ck-button label input {
            position:absolute;
            top:-20px;
        }

        .ck-button input[type=checkbox] {
            display:none;
        }

        .ck-button input:checked + span {
            background-color:#911;
            color:#fff;
        }
    </style>

    {{--Form--}}
    <div class="row bg-light p-2" style="z-index: 999; height: 5rem">
        <div class="cl-md-12">
            <form class="form-inline my-2 my-lg-0" wire:submit.prevent="findDepartures">
                <div class="form-group border-right pr-2">
                    {{--                        <label class="mx-2">Tanggal</label>--}}
                    <input type="date" wire:model.lazy="date" class="form-control form-control-lg">
                    @error('date')<br>{{ $message }}@enderror
                </div>

                <div class="form-group">

                    <select class="form-control form-control-lg" wire:model.lazy="departurePointId" wire:change="setDeparturePoint">
                        <option value="">Berangkat dari</option>
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
                    @error('departurePointId')<br>{{ $message }}@enderror
                </div>
                <div class="form-group">
                    <label class="mx-2" wire:click="switchPoint"><i class="fa fa-exchange-alt"></i></label>
                </div>
                <div class="form-group">
                    <select class="form-control form-control-lg" wire:model.lazy="arrivalPointId" wire:change="setArrivalPoint">
                        <option value="">Tujuan</option>
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
                    @error('arrivalPointId')<br>{{ $message }}@enderror
                </div>
                <button type="submit" class="btn btn-primary m-2">Cari</button>
            </form>
        </div>
    </div>

    {{--Indicator--}}
    <div class="bg-c-blue sticky-top text-white shadow-sm" style="margin-right: -15px; margin-left: -15px;">
        <div class="container">
            <div class="row">
                <div class="col-md-2 p-2 border-right ">
                    <div wire:offline>
                        You are now offline.
                    </div>
                    <input type="text" wire:model="classAnimation">
                    <h2 class="mt-4">{{ $departurePoint->code ?? '---' }} <i class="fa fa-exchange-alt" wire:click="switchPoint"></i> {{ $arrivalPoint->code ?? '---' }}</h2>
                    <small>{{ $date }}</small>
                </div>

                @isset($selectedDeparture)
                    <div class="col-md-6 p-2 border-right  animate__animated animate__slideInRight">
                        <div class="d-flex">
                            <h1 class="p-0 mt-4 flex-fill">{{ $selectedDeparture->time ?? '' }}</h1>
                        </div>
                        <small>{{ $selectedDeparture->status ?? 0 }}</small>
                        @error('selectedDeparture')<br>{{ $message }}@enderror
                    </div>

                    <div class="col-md-4 p-2  animate__animated animate__slideInRight">
                        <table class="table table-borderless">
                            <tr>
                                <td>Mobil</td>
                                <td><strong>-</strong></td>
                            </tr>
                            <tr>
                                <td>Driver</td>
                                <td><strong>-</strong></td>
                            </tr>
                        </table>
                    </div>
                @endisset


                <hr>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-{{ $classAnimation }} p-0">
                <strong class="my-2">Pilih Keberangkatan</strong>
                @forelse($departures as $departure)
                    <div class="card  text-white my-2 shadow-sm p-1 @if($departure->id == $selectedDeparture['id']) bg-c-green @else bg-c-blue @endif" wire:key="list-departure">
                        <div class="departureTime">
                            <a style="cursor: pointer;" wire:click="getDeparture({{$departure->id}})" wire:key="{{$departure->id}}">
                                <div class="card-body">
                                    <div class="d-flex d-inline"><h4>{{$departure->time}}</h4></div>
                                    <div class="text-right">
                                        {{--                            <span class="badge badge-light p-1 text-black-50">Sudah Berangkat</span>--}}
                                        <i class="far fa-user text-black-50"></i> <span class="text-black-50">{{ $departure->tickets->count() }}</span>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="col-md-12 p-4">
                        <h1 class="text-muted">Tidak ada keberangkatan</h1>
                    </div>
                @endforelse
            </div>
            @isset($selectedDeparture)
                @php($seats = $selectedDeparture->tickets->keyBy('seat'))
                <div class="col-md-6 animate__animated {{ $classAnimation }} " wire:key="$selectedDeparture->id">
                    <div class="d-flex">
                        <strong class="flex-fill">Denah Tempat Duduk</strong>
                        <button type="button" class="btn btn-primary m-1" title="Refresh" wire:click="$refresh"><i class="fas fa-sync-alt"></i></button>
                        <button type="button" class="btn btn-primary m-1" title="Cetak Manifest" wire:click="$set('isManifestForm',1)"><i class="fas fa-print"></i></button>
                        <button type="button" class="btn btn-success m-1" title="Reservasi Baru" wire:click="$set('isNew',1)"><i class="fa fa-ticket-alt"></i></button>
                    </div>
                    <table class="table table-borderless">
                        <tr>
                            <td>
                                <div class="border rounded rounded-lg px-2 pb-2">
                                    <div class="seat">
                                        <h4>1</h4>
                                        @isset($seats[1])
                                            @php($color = $seats[1]->payment_by ? 'bg-c-green' : 'bg-c-yellow')
                                            <div wire:click="getReservation({{ $seats[1]->reservation->id }})" class="w-100 border-success text-center shadow-sm {{ $color }}" style="position:absolute; bottom: 0; cursor: pointer" >
                                                <small class="clearfix">{{ $seats[1]->phone }}</small>
                                                {{ $seats[1]->reservation->id }}
                                            </div>
                                        @endisset
                                    </div>
                                </div>
                            </td>
                            <td><h4></h4></td>
                            <td><h4>D</h4></td>
                        </tr>

                        @for($i = 2; $i <= 30; $i++)
                            @php($seatPerRow = 3)
                            <tr>
                                @for($col = 1; $col <= $seatPerRow; $col++)
                                    <td>
                                        <div class="border rounded rounded-lg px-2 pb-2 ">
                                            <div class="seat">
                                                <h4>{{ $i }}</h4>
                                                @isset($seats[$i])
                                                    @php($color = $seats[$i]->payment_by ? 'bg-success' : 'bg-warning')
                                                    <div class="w-100 border-success text-center shadow-sm {{ $color }}" style="position:absolute; bottom: 0; cursor: pointer" wire:click="getReservation({{ $seats[$i]->reservation->id }})">
                                                        <small class="clearfix">{{ $seats[$i]->phone }}</small>
                                                        {{ $seats[$i]->name }}
                                                    </div>
                                                @endisset
                                            </div>
                                        </div>
                                        @if($col < $seatPerRow)
                                            @php($i++)
                                        @endif

                                    </td>
                                @endfor

                            </tr>
                        @endfor
                    </table>
                </div>

                <div class="col-md-4 p-0 ">

                    @isset($selectedReservation)
                        <div class="card shadow-sm animate__animated animate__zoomIn animate__fast">
                            <div class="card-header bg-white d-flex align-content-between">
                                <h4 class="flex-fill">Detail Reservasi</h4>
                                <button type="button" class="btn btn-light" wire:click="resetReservation"><i class="far fa-window-close"></i></button>
                            </div>
                            <div class="card-body">
                                <p>
                                    <small>Kode</small><br>
                                    <strong>{{ $selectedReservation->code ?? '----' }}</strong>
                                </p>
                                <p>
                                    <small>Nomor Telepon</small><br>
                                    <strong>087779537772</strong>
                                </p>
                                <p>
                                    <small>Nama Pemesan</small><br>
                                    <strong>Dwi Cahyadi</strong>
                                </p>
                                <p>Tiket</p>
                                <table class="table table-borderless">
                                    @foreach($selectedReservation->tickets as $ticket)
                                        <tr class="border-bottom">
                                            <td style="width: 20rem">
                                                <h3><strong>Seat {{ $ticket->seat }}</strong></h3>
                                            </td>

                                            <td align="right">
                                                <small class="text-muted">{{ $ticket->discount_name }}</small>
                                                <h4><small>Rp.</small>{{number_format($ticket->price)}}</h4>
                                            </td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td colspan=""></td>
                                        <td align="right"><h3><small>Rp.</small>{{ number_format($selectedReservation->tickets->sum('price') )}}</h3></td>
                                    </tr>

                                </table>

                                <hr>
                                @if($ticket->payment_by)
                                    <button type="button" class="btn btn-light">Cetak Ulang Tiket</button>
                                @else
                                    <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#confirmPayment">Bayar</button>
                                @endif

                                <button type="button" class="btn btn-primary btn-lg">Mutasi</button>
                            </div>
                        </div>
                    @endisset

                    @if($isNew)
                        <div class="card animate__animated animate__fadeIn">
                            <div class="card-header bg-white d-flex align-content-between">
                                <h4 class="flex-fill">Reservasi Baru</h4>
                                <button type="button" class="btn btn-light" wire:click="$emitUp('closeNewForm')"><i class="far fa-window-close"></i></button>
                            </div>
                            <div class="card-body">
                                <form onsubmit="return false">
                                    <div class="form-group">
                                        <label>Nomor Handphone</label>
                                        <input type="text" wire:model="phone" class="form-control form-control-lg" required>
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
                                    <div class="form-group">
                                        <label>Nama</label>
                                        <input type="text" wire:model="name"  class="form-control form-control-lg" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Alamat</label>
                                        <input type="text" wire:model="address" class="form-control form-control-lg" required>
                                    </div>

                                    <div class="form-group">
                                        <label>Kursi Tersedia</label>
                                        <div class="clearfix">
                                            @for($i = 1; $i <= 10; $i++)
                                                @isset($seats[$i])

                                                @else
                                                    <div class="ck-button">
                                                        <label>
                                                            <input type="checkbox" value="{{$i}}" wire:model="selectedSeats"><span>{{$i}}</span>
                                                        </label>
                                                    </div>
                                                @endisset
                                            @endfor
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label>Harga</label>
                                        <select class="form-control form-control-lg" wire:model="discountId" wire:change="setDiscount">
                                            <option value="">Harga Normal Rp.{{ number_format($selectedDeparture->price) }}</option>
                                            @forelse($discounts as $discount_)
                                                <option value="{{ $discount_->id }}">{{ $discount_->name}} Rp.{{ number_format($selectedDeparture->price-$discount_->amount) }}</option>
                                            @empty

                                            @endforelse
                                        </select>
                                    </div>

                                    <div class="form-group text-left">
                                        @php($ticketPrice = $selectedDeparture->price - ($discount->amount ?? 0))
                                        <h1 class="text-left"><small>Rp.</small>{{ number_format(count($selectedSeats) * $ticketPrice ) }}</h1>
                                    </div>
                                    <hr>
                                    <button type="submit" wire:click="saveOnly" class="btn btn-primary btn-lg">Simpan</button>
                                    <button type="submit"  data-toggle="modal" data-target="#confirmSaveAndPayment"class="btn btn-success btn-lg">Langsung Bayar</button>
                                </form>
                            </div>
                        </div>
                    @endif

                    @if($isManifestForm)

                        <div class="card">
                            <div class="card-header bg-white d-flex align-content-between">
                                <h4 class="flex-fill">Cetak Manifest</h4>
                                <button type="button" class="btn btn-light" wire:click="$emitUp('closeNewForm')"><i class="far fa-window-close"></i></button>
                            </div>
                            <div class="card-body">
                                <form onsubmit="return false">

                                    <div class="form-group">
                                        <label>Mobil</label>
                                        <select class="form-control form-control-lg">
                                            <option value="">Pilih ..</option>
                                            @forelse($cars as $car)
                                                <option value="{{ $car->id }}">{{ $car->code}} Nopol.{{ $car->license_number }}</option>
                                            @empty

                                            @endforelse
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label>Driver</label>
                                        <select class="form-control form-control-lg">
                                            <option value="">Pilih ..</option>
                                            @forelse($drivers as $driver)
                                                <option value="{{ $driver->id }}">{{ $driver->name }}</option>
                                            @empty

                                            @endforelse
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label>Kas Jalan</label>
                                        <input type="number" class="form-control form-control-lg" required>
                                    </div>

                                    <div class="form-group text-left">
                                        @php($ticketPrice = $selectedDeparture->price - ($discount->amount ?? 0))
                                        <h1 class="text-left"><small>Rp.</small>{{ number_format(count($selectedSeats) * $ticketPrice ) }}</h1>
                                    </div>
                                    <hr>
                                    <button type="submit" wire:click="saveOnly" class="btn btn-primary btn-lg">Simpan</button>
                                    <button type="submit" wire:click="saveAndPayment" class="btn btn-success btn-lg">Langsung Bayar</button>
                                </form>
                            </div>
                        </div>
                    @endif
                </div>
            @endisset
        </div>
    </div>



<!-- Modal -->
    <div class="modal fade show" id="confirmSaveAndPayment" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document" >
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Konfirmasi Simpan dan Bayar</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h4>Konfirmasi pembayaran dengan Tunai sebesar</h4>
                    <h1><small>Rp.</small>{{ number_format(count($selectedSeats) * ($ticketPrice ?? 0) ) }}</h1>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" data-dismiss="modal" wire:click="saveAndPayment">Simpan dan Bayar</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade show" id="confirmPayment" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document" >
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Konfirmasi Pembayaran</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h4>Konfirmasi pembayaran dengan Tunai sebesar</h4>
                    <h1><small>Rp.</small>{{ number_format(isset($selectedReservation->tickets) ? $selectedReservation->tickets->sum('price') ?? 0 : 0) }}</h1>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" data-dismiss="modal" wire:click="paymentOnly">Bayar</button>
                </div>
            </div>
        </div>
    </div>
</div>
