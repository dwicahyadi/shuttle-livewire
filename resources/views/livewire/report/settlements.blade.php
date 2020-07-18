<div>
    <div class="container bg-white mt-4">
        <div class="row">
            <div class="col-md-12 animate__animated animate__fadeIn animate__fast">
                <h1 class="my-3"><strong>Laporan.</strong> Settlement</h1>
                <p>Laporan settlement per tanggal masing-masing point</p>
            </div>
        </div>

        <div class="row">
            <div class="col-md-3">
                <div class="bg-light p-2 sticky-top mb-4">
                    <strong>Filter Laporan</strong>
                    <form method="get" class="">
                        <div class="form-group">
                            <label>Tanggal</label>
                            <input type="date" wire:model="date" class="form-control">
                        </div>

                        <div class="form-group">
                            <label>Point</label>
                            <select wire:model="point" class="form-control">
                                <option value="">pilih..</option>
                                @forelse($cities as $city)
                                    <optgroup label="[{{$city->code}}] {{$city->name}}">
                                        @forelse($city->points as $item)
                                            <option value="{{$item->id}}">[{{$item->code}}] {{$item->name}}</option>
                                        @empty

                                        @endforelse
                                    </optgroup>
                                @empty

                                @endforelse
                            </select>
                        </div>
                    </form>
                </div>

            </div>

            <div class="col-md-9">
                <div class="d-flex justify-content-between">
                    <div>
                        <h4>Total Setoran : {{ number_format($report->sum('amount')) }}</h4>
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
                        <th>CSO</th>
                        <th>Setoran</th>
                        <th>Note</th>
                        <th>Aksi</th>
                    </tr>
                    </thead>

                    <tbody>
                    @forelse($report ?? [] as $row)
                        <tr>
                            <td>{{ date('Y-m-d', strtotime($row->created_at)) }}</td>
                            <td>{{ $row->user->name ?? '' }}</td>
                            <td align="right">{{ number_format($row->amount)}}</td>
                            <td>{{ $row->note ?? '' }}</td>
                            <td align="center">
                                <a href="{{ route('print.settlement', ['settlement'=>$row]) }}" target="_blank">Cetak</a>
                            </td>
                        </tr>
                    @empty
                    @endforelse
                    </tbody>
                    <tfoot class="thead-light">
                    <tr>
                        <th>Total</th>
                        <th align="right" class="text-right"></th>
                        <th align="right" class="text-right">{{ number_format($report->sum('amount'))}}</th>
                        <th></th>
                        <th></th>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>

    </div>
</div>
