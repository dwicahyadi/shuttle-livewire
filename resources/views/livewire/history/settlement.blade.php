<div xmlns:wire="http://www.w3.org/1999/xhtml">
    <div class="container bg-white">
        <div class="row mt-4 bg-white">
            <div class="col-md-12 animate__animated animate__fadeIn animate__fast">
                <h1 class="my-3"><strong>History</strong> . Settlement</h1>
                <p>Daftar Settlement</p>

            </div>
        </div>
        <div class="row">
            <div class="col-md-12 animate__animated animate__fadeIn animate__fast">
                <table class="table table-hover">
                    <tbody>
                    @forelse($settlements as $settlement)
                        <tr onclick="window.open('{{ route('print.settlement',['settlement'=>$settlement]) }}', '', 'width=800,height=600')">
                            <td width="10%">
                                <img src="{{ asset('images/news.svg') }}" alt="settlement" class="img-fluid">
                            </td>
                            <td width="40%">

                                <h5>{{ $settlement->created_at }}</h5>
                                <span class="clearfix">{{ $settlement->note ?? '' }}</span>
                            </td>
                            <td>

                            </td>
                            <td align="right">
                                <h3><small>Rp.</small>{{ number_format($settlement->amount) }}</h3>
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
                    {{ $settlements->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
