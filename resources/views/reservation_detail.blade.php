<!doctype html>
<html lang="en">
<head>
    <title>Reservasi {{ $reservation->customer->name }}</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body class="bg-white">
<div class="container">
    <div class="row">
        @php($name = explode(' ',$reservation->customer->name))
        <div class="col-md-6 order-sm-2 order-md-1  d-flex align-items-center">
            <div>
                <h1 class="align-middle">Hi, {{ $name[0] }}</h1>
                <p>Bookingan kamu berhasil kami simpan. Berikut dibawah ini daftar tiket milik kamu. Pastikan kamu datang maksimal 10 menit sebelum jam keberangkatan ya...</p>
                <p>Jangan lupa follow IG kami <a href="https://www.instagram.com/suryashuttle/">@suryashuttle</a>. Info lainnya kunjungi
                    <a href="https://suryashuttle.com/">suryashuttle.com</a></p>
            </div>
        </div>
        <div class="col-md-6 order-md-2 order-sm-1">
            <img src="{{ asset('images/jumping.jpg') }}" alt="jump" class="img-fluid">
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <table class="table">
                <tbody>
                @forelse($reservation->tickets as $ticket)
                    <tr>
                        <td width="10%">
                            <img src="{{ asset('images/ticket.svg') }}" alt="ticket" class="img-fluid d-xs-none d-sm-none d-md-block">
                        </td>
                        <td width="40%">
                            <strong>{{ $ticket->name }}</strong><br>
                            Dari {{ $ticket->departure->departure_point->city->name }} - {{ $ticket->departure->departure_point->name }}
                            <br>
                            Menuju {{ $ticket->departure->arrival_point->city->name }} - {{ $ticket->departure->arrival_point->name }}
                            <h5>Seat <strong>{{ $ticket->seat }}</strong></h5>
                            <span class="clearfix">{{ $ticket->departure->date }} <strong>{{ $ticket->departure->time }}</strong></span>
                        </td>
                        <td>

                        </td>
                        <td align="right">
                            <small>{{ $ticket->discount_name ?? '' }}</small>
                            <br><strike class="text-info">Rp.{{ number_format($ticket->departure->price ?? 0) }}</strike>
                            <h3> <small>Rp.</small>{{ number_format($ticket->price) }}</h3>
                            @if($ticket->payment_at)
                                <small>Payemnt at: {{ $ticket->payment_at }}</small>
                            @else
                                <small class="text-danger">BELUM LUNAS</small>
                            @endif

                        </td>
                    </tr>
                @empty
                    <tr>
                        <td>
                            <h2 class="text-white-50">Tidak ada Transaksi</h2>
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<footer class="text-center p-4">
    {{ config('settings.company_name') }} &copy; {{date('Y')}}
</footer>
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>
</body>
</html>
