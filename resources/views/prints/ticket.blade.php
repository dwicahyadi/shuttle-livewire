<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cetak Ticket</title>
</head>
<style>
    h1, h2, h3, h4, h5, h6 {
        margin: 1px;
    }
</style>
<body onload="window.print()">
@forelse($reservation->tickets as $ticket)
    <div style="width: 300px; page-break-before: always">
        <div style="text-align: center; margin-top: 5px">
            <img src="{{ asset('images/logo bw.png') }}" alt="logo" width="120">
        </div>
        <br>
        <div>
            <small>No. Tiket</small><br>
            <strong>{{ $ticket->departure->code.'-'.$ticket->seat }}</strong>
        </div>
        <div>
            <small>Tanggal / Jam Kbrgktn</small><br>
            <strong>{{ $ticket->departure->date }} / {{ $ticket->departure->time }}</strong>
        </div>
        <div>
            <small>Keberangkatan</small><br>
            <strong>{{ $ticket->departure->departure_point->city->name }} - {{ $ticket->departure_point->name }} </strong>
        </div>
        <div>
            <small>Tujuan</small><br>
            <strong>{{ $ticket->departure->arrival_point->city->name }} - {{ $ticket->departure->arrival_point->name }} </strong>
        </div>
        <div>
            <small>Penumpang</small><br>
            <strong>{{ $ticket->name }} / ****{{ substr($ticket->phone,-4) }}</strong>
        </div>
        <div style="text-align: right">
            <h3>Seat {{ $ticket->seat }}</h3>
            <hr>
            @if($ticket->payment_by)
                <div>
                    <small><strike>Rp.{{ number_format($ticket->departure->price) }}</strike></small><br>
                    <h4>Rp.{{ number_format($ticket->price) }}</h4>
                    <small>({{ $ticket->discount_name }})</small>
                </div>
            @else
                <h3>Belum Lunas</h3>
            @endif
            <hr>
            <img src="{{ asset('images/whatsapp.svg') }}" alt="wa" width="16">&nbsp;0877 2020 7999<br>
            <img src="{{ asset('images/instagram-sketched.svg') }}" alt="wa" width="16">&nbsp;@suryashuttle
        </div>
    </div>
@empty
    <h1>Tidak ada tiket aktif</h1>
@endforelse
</body>
</html>
