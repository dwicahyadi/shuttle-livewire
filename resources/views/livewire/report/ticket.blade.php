<div>
    <div class="container bg-white mt-4">
        <div class="row">
            <div class="col-md-12 animate__animated animate__fadeIn animate__fast">
                <h1 class="my-3"><strong>Laporan.</strong> Rekap Penjualan Tiket</h1>
                <p>Rekap Penjualan Tiket per tanggal</p>
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
                            <label>Point Keberangaktan</label>
                            <select wire:model="point" class="form-control">
                                <option value="">Semua</option>
                                @forelse($cities as $city)
                                    <optgroup label="[{{$city->code}}] {{$city->name}}">
                                        @forelse($city->points as $item)
                                            <option value="{{$item->name}}">[{{$item->code}}] {{$item->name}}</option>
                                        @empty

                                        @endforelse
                                    </optgroup>
                                @empty

                                @endforelse
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Status</label>
                            <select wire:model="status" class="form-control">
                                <option value="">Semua</option>
                                <option value="paid">Paid</option>
                                <option value="unpaid">Unpaid</option>
                                <option value="cancel">Cancel</option>
                            </select>
                        </div>
                    </form>
                </div>
            </div>

            <div class="col-md-9">
                <div class="card card-body shadow-sm">
                    <strong>Summary</strong>
                    <table class="w-100">
                        <tr>
                            <td>
                                <small class="clearfix">Total Pendapatan</small>
                                <strong>{{ number_format($report->where('status','paid')->sum('price')) }}</strong>
                            </td>

                            <td>
                                <small class="clearfix">Total Tiket Valid</small>
                                <strong>{{ number_format($report->where('status','paid')->count('price')) }}</strong>
                            </td>

                            <td>
                                <small class="clearfix">Total Jadwal</small>
                                <strong>{{ number_format($report->groupBy('departure_code')->count('price')) }}</strong>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="d-flex justify-content-between">
                    <div>

                    </div>
                    <div>
                        <a href="#">[Analisa Data]</a>
                        <a href="#">[Export Data]</a>
                    </div>
                </div>

                <table class="table table-bordered table-striped table-hover table-responsive">
                    <thead class="thead-light">
                    <tr>
                        <th>Telepon</th>
                        <th>Nama</th>
                        <th>Point Keberangkatan</th>
                        <th>Point Tujuan</th>
                        <th>Tanggal</th>
                        <th>Jam</th>
                        <th>No Kursi</th>
                        <th>Diskon</th>
                        <th>Harga Tiket</th>
                        <th>Status</th>
                        <th>CSO</th>
                        <th>Pembayaran Oleh</th>
                        <th>Settlement</th>
                        <th>Aksi</th>
                    </tr>
                    </thead>

                    <tbody>
                    @forelse($report ?? [] as $row)
                        <tr>
                            <td>{{ $row->phone }}</td>
                            <td>{{ $row->name }}</td>
                            <td>{{ $row->departure_point }}</td>
                            <td>{{ $row->arrival_point }}</td>
                            <td>{{ $row->date }}</td>
                            <td>{{ $row->time }}</td>
                            <td>{{ $row->seat }}</td>
                            <td>{{ $row->discount_name }}</td>
                            <td align="right">{{ number_format($row->price)}}</td>
                            <td>{{ $row->status }}</td>
                            <td>{{ $row->reservation_by }}</td>
                            <td>{{ $row->payment_by }}</td>
                            <td>{{ $row->settlemnt_id ? 'Sudah' : 'Belum' }}</td>
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
