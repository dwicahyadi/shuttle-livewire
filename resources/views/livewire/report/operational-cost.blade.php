<div>
    <div class="container bg-white mt-4">
        <div class="row">
            <div class="col-md-12 animate__animated animate__fadeIn animate__fast">
                <h1 class="my-3"><strong>Laporan.</strong> Biaya Operasional</h1>
                <p>Laporan BOP per tanggal masing-masing keberangkatan</p>
            </div>
        </div>

        <div class="row">
            <div class="col-md-3">
                <div class="bg-light p-2 sticky-top mb-4">
                    <strong>Filter Laporan</strong>
                    <form method="get" class="">
                        <div class="form-group">
                            <label>Tanggal Awal</label>
                            <input type="date" wire:model="startDate" class="form-control">
                        </div>

                        <div class="form-group">
                            <label>Tanggal Akhir</label>
                            <input type="date" wire:model="endDate" class="form-control">
                        </div>


                    </form>
                </div>

            </div>


            <div class="col-md-9">
                <div class="d-flex justify-content-between">
                    <div>
                        <h4>Total BOP : {{ number_format($report->sum('costs')) }}</h4>
                    </div>
                    <div>
                        <a href="#">[Analisa Data]</a>
                        <a href="#">[Export Data]</a>
                    </div>
                </div>

                <table class="table table-bordered table-striped table-hover">
                    <thead class="thead-light">
                    <tr>
                        <th>Tanggal</th>
                        <th>Jam</th>
                        <th>Keberangkatan</th>
                        <th>Tujuan</th>
                        <th>Driver</th>
                        <th>Unit</th>
                        <th>BOP</th>
                    </tr>
                    </thead>

                    <tbody>
                    @forelse($report ?? [] as $schedule)
                        <tr>
                            @foreach($schedule->departures as $departure)
                                <td>{{ $departure->date }}</td>
                                <td>{{ $departure->time }}</td>
                                <td>{{ $departure->departure_point->name }}</td>
                                <td>{{ $departure->arrival_point->name }}</td>
                            @endforeach
                            <td>{{ $schedule->driver->name }}</td>
                            <td>{{ $schedule->car->code }}</td>
                            <td>{{ number_format($schedule->costs) }}</td>
                        </tr>
                    @empty
                    @endforelse
                    </tbody>
                    <tfoot class="thead-light">
                    <tr>
                        <th>Total</th>
                        <th align="right" class="text-right" colspan="5"></th>
                        <th align="right" class="text-right">{{ number_format($report->sum('costs'))}}</th>

                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>

    </div>
</div>
