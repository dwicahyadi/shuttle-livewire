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
