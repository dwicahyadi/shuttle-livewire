<div>

    <table class="table table-borderless animate__animated animate__fadeInUp animate__faster">
        <tr>
            <td class="" width="{{ 100/$seatPerRow }}%">
                @isset($bookedSeats[1])
                    <div class="border shadow-sm p-2 @if($selectedReservation['id'] == $bookedSeats[1]->reservation->id) bg-info @else bg-white @endif ">
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
                    <div class="border p-2">
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
                <img src="{{ asset('images/steer.svg') }}" alt="driver" class="w-25 clearfix" style="cursor: pointer"><br>
                <strong>{{ $departure->schedule->driver->name ?? 'Driver' }}</strong>
            </td>
        </tr>

        @for($i = 1; $i <= $totalSeats; $i++)

            <tr>
                @for($col = 1; $col <= $seatPerRow; $col++)
                    <td class="">
                        @isset($bookedSeats[$i])
                            <div class="border shadow-sm p-2 @if($selectedReservation['id'] == $bookedSeats[$i]->reservation->id) bg-info @else bg-white @endif">
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
                            <div class="border p-2">
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
