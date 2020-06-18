@php($seatPerRow = 3)
@php($seats = $selectedDeparture->tickets->keyBy('seat'))
<table class="table table-borderless">
    <tr>
        <td class="" width="{{ 100/$seatPerRow }}%">
            <div class="border  shadow-sm bg-white">
                <div class="seat">
                    <h4 class="m-1">1</h4>
                    @isset($seats[1])
                        @php($color = $seats[1]->payment_by ? 'bg-c-green' : 'bg-c-yellow')
                        <div wire:click="getReservation({{ $seats[1]->reservation->id }})" class="w-100 border-success text-center shadow-sm  {{ $color }}" style="position:absolute; bottom: 0; cursor: pointer" >
                            @if($selectedReservation['id'] == $seats[1]->reservation->id)
                                <h5 class="text-white bg-primary">Dipilih</h5>
                            @endif
                            <small class="clearfix">{{ $seats[1]->phone }}</small>
                            <span class="clearfix">{{ $seats[1]->name }}</span>
                        </div>
                    @endisset
                </div>
            </div>
        </td>
        <td class="" width="{{ 100/$seatPerRow }}%"><h4></h4></td>
        <td class="" width="{{ 100/$seatPerRow }}%" style="vertical-align: middle; text-align: center">
            <img src="{{ asset('images/steer.svg') }}" alt="driver" class="w-25 clearfix" wire:click="$set('isManifestForm',1)" style="cursor: pointer"><br>
            <strong>{{ $selectedDeparture->schedule->driver->name }}</strong>
        </td>
    </tr>

    @for($i = 2; $i <= $totalSeats; $i++)

        <tr>
            @for($col = 1; $col <= $seatPerRow; $col++)
                <td class="">
                    <div class="border  shadow-sm">
                        <div class="seat">
                            <h4 class="m-1">{{ $i }}</h4>
                            @isset($seats[$i])
                                @php($color = $seats[$i]->payment_by ? 'bg-c-green' : 'bg-c-yellow')
                                <div wire:click="getReservation({{ $seats[$i]->reservation->id }})" class="w-100 border-success text-center shadow-sm  {{ $color }}" style="position:absolute; bottom: 0; cursor: pointer" >
                                    @if($selectedReservation['id'] == $seats[$i]->reservation->id)
                                        <h5 class="text-white bg-primary">Dipilih</h5>
                                    @endif
                                    <small class="clearfix">{{ $seats[$i]->phone }}</small>
                                    {{ $seats[$i]->name}}
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
