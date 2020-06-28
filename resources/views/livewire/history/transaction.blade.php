<div xmlns:wire="http://www.w3.org/1999/xhtml">
    <div class="row mt-4 bg-white">
        <div class="col-md-12 animate__animated animate__fadeIn animate__fast">
            <h1 class="my-3"><strong>History</strong> . Reservasi</h1>
            <p>Daftar tiket yang direservasikan oleh saya</p>

        </div>
    </div>

    <div class="row">
        <div class="col-md-8 offset-2 animate__animated animate__fadeIn animate__fast">
            <div class="sticky-top bg-white p-2 d-flex">
                <div class="flex-fill">
                    <input type="text" wire:model="search" class="form-control-lg form-control" placeholder="Cari nama atau no telepon">
                </div>
             </div>
            <table class="table">
                <tbody>
                @forelse($transactions as $transaction)
                    <tr>
                        <td width="10%">
                            <img src="{{ asset('images/ticket.svg') }}" alt="ticket" class="img-fluid">
                        </td>
                        <td width="40%">
                            <strong>{!!  str_ireplace($search,'<span class="bg-warning">'.$search.'</span>', $transaction->name) !!}</strong> <span class="clearfix">{!!  str_ireplace($search,'<span class="bg-warning">'.$search.'</span>', $transaction->phone) !!}</span>
                            <h5>{{ $transaction->departure->departure_point->code ?? '' }} - {{ $transaction->departure->departure_point->code ?? '' }} Seat <strong>{{ $transaction->seat }}</strong></h5>
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
                {{ $transactions->links() }}
            </div>
        </div>
    </div>
</div>
