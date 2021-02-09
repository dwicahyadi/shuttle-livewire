<div>
    <div class="container bg-white mt-4">
        <div class="row">
            <div class="col-md-12 animate__animated animate__fadeIn animate__fast">
                <h1 class="my-3"><strong>Laporan.</strong> Pendapatan Tiket</h1>
                <p>Laporan pendapatan kotor per bulan</p>
            </div>
        </div>

        <div class="row">
            <div class="col-md-3">
                <div class="bg-light p-2 sticky-top mb-4">
                    <strong>Filter Laporan</strong>
                    <form method="get" class="">
                        <div class="form-group">
                            <label>Bulan: {{ $month }}</label>
                            <select wire:model="month"  class="form-control">
                                @for($i = 1; $i <= 12; $i++)
                                    <option value="{{ $i }}">{{ date('F', mktime(0, 0, 0, $i, 1)) }}</option>
                                @endfor
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Tahun</label>
                            <select wire:model="year" name="year" class="form-control">
                                <option value="2021">2021</option>
                                <option value="2020">2020</option>
                            </select>
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
                        <h4>Total Penumpang : {{ number_format($report->sum('total_tickets')) }}</h4>
                        <h4>Total Omzet : {{ number_format($report->sum('amount_tickets')) }}</h4>
                    </div>
                    <div>
                        <a href="#">[Analisa Data]</a>
                        <a href="#">[Export Data]</a>
                    </div>
                </div>

                <table class="table table-bordered table-striped table-hover">
                    <thead class="thead-light">
                    <tr>
                        <th>Tgl</th>
                        <th>Penumpang</th>
                        <th>Omzet</th>
                        <th>Aksi</th>
                    </tr>
                    </thead>

                    <tbody>
                    @forelse($report ?? [] as $row)
                        <tr>
                            <td>{{ date('d',strtotime($row->date)) }}</td>
                            <td align="right">{{ number_format($row->total_tickets)}}</td>
                            <td align="right">{{ number_format($row->amount_tickets)}}</td>
                            <td align="center">
                                <a href="{{ route('report.settlements', ['point'=>$point, 'date'=>$row->date]) }}" class="btn btn-primary btn-sm" >Daftar Settlment</a>
                            </td>
                        </tr>
                    @empty
                    @endforelse
                    </tbody>
                    <tfoot class="thead-light">
                    <tr>
                        <th>Total</th>
                        <th align="right" class="text-right">{{ number_format($report->sum('total_tickets'))}}</th>
                        <th align="right" class="text-right">{{ number_format($report->sum('amount_tickets'))}}</th>
                        <th></th>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>

    </div>
</div>
