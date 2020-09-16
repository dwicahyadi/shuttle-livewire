<div class="p-2">
    @if($selectedReservation->expired_at)
        <div class="p-2 bg-warning">
            Pembayaran melalui transfer. Akan dibatalkan otomatis pada <strong>{{ $selectedReservation->expired_at }}</strong>
        </div>
    @endif

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

    <p>
        <small>Note</small><br>
        <strong>{{ $selectedReservation->note ?? '-' }}</strong>
    </p>

    <p>Tiket</p>
    <table class="table table-borderless">
        @if(count($selectedReservation->tickets))
            @foreach($selectedReservation->tickets->groupBy('departure_id') as $index => $row)
                <tr>
                    <td colspan="2">
                        <a href="{{ route('reservation',[
                                'date'=>$row[0]->departure->date,
                                'departurePointId'=>$row[0]->departure->departure_point->id,
                                'arrivalPointId'=>$row[0]->departure->arrival_point->id,
                                'selectedDepartureId'=>$row[0]->departure_id,
                            ]) }}">
                            {{ $row[0]->departure->departure_point->code }} -
                            {{ $row[0]->departure->arrival_point->code }} |
                            {{ $row[0]->departure->date}}
                            {{ $row[0]->departure->time}}
                        </a>
                    </td>
                </tr>

                @forelse($row as $ticket)
                    @if($ticket->departure_id == $selectedDepartureId)
                        <tr class="border-bottom">
                            <td style="width: 20rem">

                                <h5><input type="checkbox" value="{{ $ticket->id }}" wire:model="selectedTickets"> <strong>Seat {{ $ticket->seat }}</strong></h5>
                            </td>

                            <td align="right">
                                <small class="text-muted">{{ $ticket->discount_name }}</small>
                                <h5><small>Rp.</small>{{number_format($ticket->price)}}</h5>
                            </td>
                        </tr>
                    @else
                        <tr class="border-bottom text-muted">
                            <td style="width: 20rem">
                                <h5><strong>Seat {{ $ticket->seat }}</strong></h5>
                            </td>

                            <td align="right">
                                <small class="text-muted">{{ $ticket->discount_name }}</small>
                                <h5><small>Rp.</small>{{number_format($ticket->price)}}</h5>
                            </td>
                        </tr>
                    @endif
                @empty

                @endforelse
            @endforeach
        @endif
        <tr>
            <td colspan="">Total</td>
            <td align="right"><h4><small>Rp.</small>{{ number_format($selectedReservation->tickets->sum('price') )}}</h4></td>
        </tr>

    </table>

    <div class="bg-light p-0">
        <strong class="m-4">Logs</strong>
        @empty($activities)
            <span>No activites logged</span>
        @else
            <ul class="list-group">
                @foreach($activities as $activity)
                    <li class="list-group-item border-right-0 border-left-0 bg-transparent">
                        {{ $activity->description }} by <span class="text-primary">{{ $activity->causer->name }}</span> <span class="float-right">{{ \Carbon\Carbon::createFromTimeStamp(strtotime($activity->created_at))->diffForHumans() }}</span>
                    </li>
                @endforeach
            </ul>
        @endempty
    </div>
</div>
