<div>
    <div class="shadow-sm sticky-top p-2 bg-white border-top" style="height: 4rem;">
        <div class="d-flex w-100 mx-auto justify-content-between">
            <button type="button" class="btn btn-sm" data-toggle="modal" data-target="#confirmManifest">
                <img src="{{ asset('images/news.svg') }}" alt="new" width="18">
                <br> Manifest
            </button>

            <button type="button" class="btn btn-sm" title="Refresh" wire:click="$refresh">
                <img src="{{ asset('images/reload.svg') }}" alt="new" width="18">
                <br> Reload
            </button>
        </div>
    </div>

    <div id="layout">
        @if($departure)
            @php($seatPerRow = config('settings.seat_per_row'))
            @php($totalSeats = $departure->schedule->seats)
            <div class="card mx-2 my-3 bg-white animate__animated animate__zoomIn animate__faster">
                <div class="card-body d-flex justify-content-start">
                    <div class="border-right p-2">
                        <h1 class="mt-4">{{ substr($departure->time , 0, 5) }}</h1>
                        @forelse($departure->options as $option)
                            @continue($option->time == $departure->time)
                            <a href="{{ route('reservation',['selectedDepartureId'=>$option->id,'departurePointId'=>$option->departure_point_id,'arrivalPointId' => $option->arrival_point_id, 'date'=>$option->date]
    ) }}" class="badge badge-primary">
                                {{ substr($option->time,0,5) }}
                            </a>
                        @empty
                            <span>-</span>
                        @endforelse
                    </div>
                    <div>
                        <span class="clearfix">Dari : <strong>{{ $departure->departure_point->name ?? '---' }}</strong></span>
                        <span class="clearfix">Tujuan : <strong>{{ $departure->arrival_point->name ?? '---' }}</strong></span>
                        <span class="clearfix">Tujuan : <strong>{{ $departure->date}}</strong></span>
                        <small class="">{{ $departure->code ?? '' }} </small>

                    </div>
                </div>


            </div>

            <div class="my-2 p-2">
                <div class="btn-group btn-block">
                    <button class="btn btn-light" wire:click="$emit(setNewForm, {{ $departure->id }})"><i class="fa fa-gift text-info"></i> <strong> Paket Baru</strong></button>
                    <button class="btn btn-light"><i class="fa fa-ticket-alt text-success"></i> <strong> Tiket Baru</strong></button>
                </div>
            </div>

            <table class="table table-borderless animate__animated animate__zoomIn animate__delay">
                <tr>
                    <td class="" width="{{ 100/$seatPerRow }}%">
                        @isset($bookedSeats[1])
                            <div class="border shadow-sm p-2 @if($selectedReservation['id'] == $bookedSeats[1]->reservation->id) bg-info @else bg-white @endif " wire:click="getReservation({{ $bookedSeats[1]->reservation->id }})">
                                <div class="seat  @if($selectedReservation['id'] == $bookedSeats[1]->reservation->id) bg-info @else bg-white @endif">
                                    <h4>{{ 1 }} @if($bookedSeats[1]->payment_by) <span class="text-success">LUNAS</span> @endif </h4>
                                    <div class="text-center">
                                        @if($bookedSeats[1]->departure_point_id != $departurePointId)
                                            <small class="bg-danger clearfix text-white">Beda Point</small>
                                        @endif
                                        <strong class="bg-secondary text-white px-1">{{ \Illuminate\Support\Str::limit($bookedSeats[1]->name,10,'...') }} </strong><br>
                                        {{--                            <small class="bg-warning px-1">{{ $bookedSeats[1]->discount_name ?? 'Umum' }}</small>--}}
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
                        <strong>{{ $departure->schedule->driver->name ?? 'Driver' }}</strong>
                    </td>
                </tr>

                @for($i = 2; $i <= $totalSeats; $i++)

                    <tr>
                        @for($col = 1; $col <= $seatPerRow; $col++)
                            <td class="">
                                @isset($bookedSeats[$i])
                                    <div class="border shadow-sm p-2 @if($selectedReservation['id'] == $bookedSeats[$i]->reservation->id) bg-info @else bg-white @endif" wire:click="getReservation({{ $bookedSeats[$i]->reservation->id }})">
                                        <div class="seat">
                                            <h4>{{ $i }} @if($bookedSeats[$i]->payment_by) <span class="text-success">LUNAS</span> @endif</h4>
                                            <div class="text-center">
                                                @if($bookedSeats[$i]->departure_point_id != $departurePointId)
                                                    <small class="bg-danger clearfix text-white">Beda Point</small>
                                                @endif
                                                <strong class="bg-secondary text-white px-1">{{ \Illuminate\Support\Str::limit($bookedSeats[$i]->name,10,'...') }} </strong><br>
                                                {{--                                    <small class="bg-warning px-1">{{ $bookedSeats[$i]->discount_name ?? 'Umum' }}</small>--}}
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
        @else
            <h2 class="text-muted">Silakan Pilih Jadwal</h2>
        @endif
    </div>

  @section('script')
        <script>
            document.addEventListener("livewire:load", function(event) {
                window.livewire.on('selectDeparture', data => {
                    var element = document.getElementById('layout');
                    if (element){
                        element.innerHTML = '';
                    }
                })
            });
        </script>
    @endsection
</div>
