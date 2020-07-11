<div>
    <div class="row">
        <div class="col-md-6" style="height: 25rem; overflow-y: scroll">
            <form class="p-2" wire:submit.prevent="findDepartures">
                <div class="form-group">
                    {{--                        <label class="mx-2">Tanggal</label>--}}
                    <input type="date" wire:model.lazy="date" class="form-control">
                    @error('date')<br>{{ $message }}@enderror
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <select class="form-control" wire:model.lazy="departurePointId" wire:change="setDeparturePoint">
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
                        <select class="form-control" wire:model.lazy="arrivalPointId" wire:change="setArrivalPoint">
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
                    </div>
                    <button type="button" class="btn btn-block" wire:click="switchPoint"  title="Klik untuk Switch Point"><i class="fa fa-exchange-alt"></i></button>
                </div>
                {{--  <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block">Cari</button>
                </div>--}}
            </form>

            <div>
                <ul class="list-group">
                    @forelse($departures as $departure)
                        <li class="list-group-item list-group-item-action @if($departure->id == $selectedDeparture['id']) bg-primary text-white @endif" wire:click="getDeparture({{$departure->id}})" wire:key="{{$departure->id}}">
                            <div class="d-flex">
                                <div class="mr-2">
                                    <i class="text-black-50 far fa-clock fa-2x mt-2"></i>
                                </div>
                                <div class="flex-fill">
                                    <strong class="clearfix">{{ substr($departure->time, 0,5) }}</strong>
                                    <small class="text-muted">Note: {{ $departure->schedule->note }}</small>
                                </div>
                                <div>
                                    <label class="badge badge-success">{{ $departure->schedule->seats - $departure->tickets->count() }}</label>
                                </div>
                            </div>
                        </li>
                    @empty
                        <div class="col-md-12 p-4">
                            <h5 class="text-muted">Tidak ada keberangkatan</h5>
                        </div>
                    @endforelse
                </ul>
            </div>
        </div>

        <div class="col-md-6" style="height: 25rem; overflow-y: scroll">
            {{ var_dump($selectedTickets) }}
            {{ var_dump($selectedSeats) }}
            @php($seatPerRow = config('settings.seat_per_row'))
            @php($seats = $selectedDeparture->tickets->keyBy('seat'))
            <table class="table table-borderless">
                <tr>
                    <td class="" width="{{ 100/$seatPerRow }}%">
                        @isset($seats[1])
                            <div class="border shadow-sm p-2 @if($selectedReservation['id'] == $seats[1]->reservation->id) bg-info @else bg-white @endif" wire:click="getReservation({{ $seats[1]->reservation->id }})">
                                <div class="seat">
                                    <h4>{{ 1 }} @if($seats[1]->payment_by) <span class="text-success">LUNAS</span> @endif</h4>
                                    <div class="text-center">
                                        <strong class="bg-secondary text-white px-1">{{ \Illuminate\Support\Str::limit($seats[1]->name,10,'...') }} </strong><br>
                                        <small class="bg-warning px-1">{{ $seats[1]->discount_name ?? 'Umum' }}</small>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="border p-2 @if(in_array(1, $selectedSeats)) bg-info @endif" wire:click="pickSeat({{ 1 }})">
                                <div class="seat">
                                    <h4>{{ 1 }}</h4>

                                </div>
                            </div>
                        @endisset
                    </td>
                    @if($seatPerRow > 2)
                        <td class="" width="{{ 100/$seatPerRow }}%"><h4></h4></td>
                    @endif
                    <td class="" width="{{ 100/$seatPerRow }}%" style="vertical-align: middle; text-align: center">
                        <img src="{{ asset('images/steer.svg') }}" alt="driver" class="w-25 clearfix" wire:click="$set('isManifestForm',1)" style="cursor: pointer"><br>
                        <strong>{{ $selectedDeparture->schedule->driver->name ?? 'Driver' }}</strong>
                    </td>
                </tr>

                @for($i = 2; $i <= $totalSeats; $i++)

                    <tr>
                        @for($col = 1; $col <= $seatPerRow; $col++)
                            <td class="">
                                @isset($seats[$i])
                                    <div class="border shadow-sm p-2 @if($selectedReservation['id'] == $seats[$i]->reservation->id) bg-info @else bg-white @endif" wire:click="getReservation({{ $seats[$i]->reservation->id }})">
                                        <div class="seat">
                                            <h4>{{ $i }} @if($seats[$i]->payment_by) <span class="text-success">LUNAS</span> @endif</h4>
                                            <div class="text-center">
                                                <strong class="bg-secondary text-white px-1">{{ \Illuminate\Support\Str::limit($seats[$i]->name,10,'...') }} </strong><br>
                                                <small class="bg-warning px-1">{{ $seats[$i]->discount_name ?? 'Umum' }}</small>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div class="border p-2 @if(in_array($i, $selectedSeats)) bg-info @endif" wire:click="pickSeat({{ $i }})">
                                        <div class="seat">
                                            <h4>{{ $i }}</h4>

                                        </div>
                                    </div>
                                @endisset
                                @if($col < $seatPerRow)
                                    <?php
                                        $i++;
                                        if($i > $totalSeats) break;
                                    ?>
                                @endif
                            </td>
                        @endfor

                    </tr>
                @endfor
            </table>

        </div>
    </div>

    <div class="row">
        <div class="col-md-12 text-right">
            @if(count($selectedSeats) == count($selectedTickets))
             <button type="button" class="btn btn-primary" wire:click="reschedule">Simpan</button>
            @endif
        </div>
    </div>
</div>
