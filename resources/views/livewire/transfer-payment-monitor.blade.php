<div class="container bg-white" xmlns:wire="http://www.w3.org/1999/xhtml">
    <div class="row mt-4 bg-white">
        <div class="col-md-12 animate__animated animate__fadeIn animate__fast">
            <h1 class="my-3"><strong>Reservasi</strong> . Monitor Pembayaran Transfer</h1>
            <p>Daftar reservasi menunggu pembayaran via transfer</p>

        </div>
    </div>

    <div class="row">
        <div class="col-md-12 animate__animated animate__fadeIn animate__fast">
            <div class="sticky-top bg-white p-2 d-flex">
                <div class="flex-fill">
                    <input type="text" wire:model="transferAmount" class="form-control-lg form-control" placeholder="Masukan nominal transfer">
                </div>
            </div>
            <div class="table-responsive">
                <table class="table">
                    <thead class="thead-light">
                    <tr>
                        <th>Nama</th>
                        <th>Telepon</th>
                        <th>Reservasi</th>
                        <th>Transfer Amount</th>
                        <th>Expire Time</th>
                        <th>Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($reservations as $reservation)
                        <tr>
                            <td>{{ $reservation->customer->name }}</td>
                            <td>{{ $reservation->customer->phone }}</td>
                            <td>
                                @foreach($reservation->tickets->groupBy('departure_id') as $index => $row)
                                    <strong>
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
                                    </strong>
                                    <br>
                                    @forelse($row as $ticket)
                                        <span class="clearfix">Seat {{ $ticket->seat }}</span>
                                    @empty

                                    @endforelse
                                    <br>
                                @endforeach
                            </td>
                            <td align="right"><strong>{{ number_format($reservation->transfer_amount) }}</strong></td>
                            <td>{{ $reservation->expired_at }}</td>
                            <td>
                                <button wire:click="payment({{ $reservation->id }})">Sudah Transfer</button>
                            </td>
                        </tr>
                    @empty

                    @endforelse
                    </tbody>
                </table>
            </div>
            <div class="ml-2">
            </div>
        </div>
    </div>
</div>
