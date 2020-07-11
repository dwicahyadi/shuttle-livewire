<div class="p-2">
    <p>
        <small>Kode</small><br>
        <strong>{{ $selectedReservation->code ?? '----' }}</strong>
    </p>
    <p>
        <small>Nomor Telepon</small><br>
        <strong>{{ $selectedReservation->customer->phone }}</strong>
    </p>
    <p>
        <small>Nama Pemesan</small><br>
        <strong>{{ $selectedReservation->customer->name }}</strong>
    </p>
    <p>Tiket</p>
    <table class="table table-borderless">
        @if(count($selectedReservation->tickets))
            @foreach($selectedReservation->tickets as $ticket)
                @if($ticket->departure_id == $selectedDepartureId)
                    <tr class="border-bottom">
                        <td style="width: 20rem">

                            <h3><input type="checkbox" value="{{ $ticket->id }}" wire:model="selectedTickets"> <strong>Seat {{ $ticket->seat }}</strong></h3>
                        </td>

                        <td align="right">
                            <small class="text-muted">{{ $ticket->discount_name }}</small>
                            <h4><small>Rp.</small>{{number_format($ticket->price)}}</h4>
                        </td>
                    </tr>
                @else
                    <tr class="border-bottom text-muted">
                        <td style="width: 20rem">
                            <a href="{{ route('reservation',[
                                'date'=>$ticket->departure->date,
                                'departurePointId'=>$ticket->departure->departure_point->id,
                                'arrivalPointId'=>$ticket->departure->arrival_point->id,
                                'selectedDepartureId'=>$ticket->departure_id,
                            ]) }}">
                                {{ $ticket->departure->departure_point->code }} -
                                {{ $ticket->departure->arrival_point->code }} |
                                {{ $ticket->departure->date}}
                                {{ $ticket->departure->time}}
                            </a>
                            <h3><strong>Seat {{ $ticket->seat }}</strong></h3>
                        </td>

                        <td align="right">
                            <small class="text-muted">{{ $ticket->discount_name }}</small>
                            <h4><small>Rp.</small>{{number_format($ticket->price)}}</h4>
                        </td>
                    </tr>
                @endif
            @endforeach
        @endif
        <tr>
            <td colspan=""></td>
            <td align="right"><h3><small>Rp.</small>{{ number_format($selectedReservation->tickets->sum('price') )}}</h3></td>
        </tr>

    </table>

    <hr>
</div>
