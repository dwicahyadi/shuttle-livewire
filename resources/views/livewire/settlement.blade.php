<div xmlns:wire="http://www.w3.org/1999/xhtml">
    @php( $methods = ['ONLINE PAYMENT','CARD PAYMENT','CASH PAYMENT'])
    <div class="container">
        <div class="row bg-white">
            <div class="col-md-12 animate__animated animate__fadeIn animate__fast">
                <h1 class="my-3"><strong>Settlement</strong> </h1>
                <p>Proses settlement</p>

            </div>
        </div>

        <div class="row bg-white">
            <div class="col-md-6">
                <table class="table">
                    <tbody>
                    @forelse($transactions as $transaction)
                        <tr>
                            <td width="10%">
                                <img src="{{ asset('images/ticket.svg') }}" alt="ticket" class="img-fluid">
                            </td>
                            <td width="40%">
                                <strong>{{ $transaction->name }}</strong> <span class="clearfix"> {{ $transaction->phone }}</span>
                                <h5>CBN - BDG Seat <strong>{{ $transaction->seat }}</strong></h5>
                                <span class="clearfix">{{ $transaction->departure->date }} <strong>{{ $transaction->departure->time }}</strong></span>
                            </td>
                            <td>

                            </td>
                            <td align="right">
                                <small>{{ $transaction->discount_name ?? '' }}</small>
                                <h3><small>Rp.</small>{{ number_format($transaction->price) }}</h3>
                                @if($transaction->payment_at)
                                    <small>Payemnt at: {{ $transaction->payment_at }}</small>
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
                <div class="ml-2">

                </div>
            </div>

            <div class="col-md-6">
                <div class="card sticky-top">
                    <div class="card-body">
                        <h1>Resume</h1>
                        <table class="table">
                            @forelse($transactions->groupBy('discount_name') as $discount => $value)
                                <tr>
                                    <td>@empty($discount ) Umum @else {{ $discount }} @endempty</td>
                                    <td align="right"><h4>{{ number_format($value->sum('price')) }}</h4></td>
                                </tr>
                            @empty
                                <tr>
                                    <td>Tidak ada tagihan</td>
                                </tr>
                            @endforelse
                            <tr>
                                <td></td>
                                <td align="right"><h1>{{ number_format($transactions->sum('price')) }}</h1></td>
                            </tr>
                        </table>

                        <table class="table table-borderless">
                            @foreach($methods as $method)
                                <tr>
                                    <td>{{ $method }}</td>
                                    <td align="right">{{ number_format($transactions->where('payment_method',$method)->sum('price')) }}</td>
                                </tr>

                            @endforeach
                        </table>

                        <form wire:submit.prevent="save">
                            <textarea class="form-control form-control-lg my-2" placeholder="Catatan..."></textarea>
                            <label><input type="checkbox" required> Dengan ini Saya menyatakan telah menyetorkan Uang hasil penjualan sesuai dengan besar tagihan.</label>
                            <button class="mr-auto btn btn-primary btn-lg">Settlement</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
