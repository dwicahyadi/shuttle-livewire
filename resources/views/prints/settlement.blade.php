<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cetak Manifest</title>
</head>
<style>
    h1, h2, h3, h4, h5, h6 {
        margin: 1px;
    }
</style>
<body onload="window.print()">
@php($transactions = $settlement->tickets )
<?php ( $methods = ['ONLINE PAYMENT','CARD PAYMENT','CASH PAYMENT']); ?>
<div style="width: 300px; page-break-before: always">
    <div style="text-align: center; margin-top: 5px">
        <img src="{{ asset('images/logo bw.png') }}" alt="logo" width="120">
    </div>
    <br>
    <h2>Settlement</h2>

    <table>
        <tr>
            <td>CSO</td>
            <td>: {{ $settlement->user->name ?? '' }}</td>
        </tr>
        <tr>
            <td>Waktu Settlement</td>
            <td>: {{ $settlement->created_at ?? '' }}</td>
        </tr>
        <tr>
            <td>Amount</td>
            <td>: {{ number_format( $settlement->amount ?? 0) }}</td>
        </tr>
        <tr>
            <td>Note</td>
            <td>: {{ $settlement->note ?? '' }}</td>
        </tr>
    </table>
    <hr>

    <strong>Jenis Tiket</strong>
    <table style="width: 100%">
        @forelse($transactions->groupBy('discount_name') as $discount => $value)
            <tr>
                <td>@empty($discount ) Umum @else {{ $discount }} @endempty</td>
                <td align="right">{{ number_format($value->sum('price')) }}</td>
            </tr>
        @empty
            <tr>
                <td>Tidak ada tagihan</td>
            </tr>
        @endforelse
        <tr>
            <td>TOTAL</td>
            <td align="right">{{ number_format($transactions->sum('price')) }}</td>
        </tr>
    </table>
    <br>
    <strong>Metode Pembayaran</strong>
    <table style="width: 100%">
        @foreach($methods as $method)
            <tr>
                <td>{{ $method }}</td>
                <td align="right">{{ number_format($transactions->where('payment_method',$method)->sum('price')) }}</td>
            </tr>
        @endforeach
    </table>
    <br>
    CSO <br><br><br>
    {{ $settlement->user->name ?? '' }}
    <br>
    <small>Dicetak {{ now() }}</small>

</div>
</body>
</html>
