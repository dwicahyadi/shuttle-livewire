<div xmlns:wire="http://www.w3.org/1999/xhtml">
    <div class="container bg-white">
        <div class="row mt-4">
            <div class="col-md-12  animate__animated animate__fadeIn animate__fast">
                <h1 class="my-3"><strong>Jadwal</strong> . Buka Jadwal Multi Point</h1>
                <p>Buka Jadwal untuk periode</p>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <form action="">
                    @if($step == 1)
                        <div>
                            <h4>Step {{ $step }}. Tentukan Periode</h4>
                            <div class="form-group">
                                <label>Dari Tanggal</label>
                                <input type="date" class="form-control" wire:model="fromDate">
                            </div>
                            <div class="form-group">
                                <label>Sampai Tanggal</label>
                                <input type="date" class="form-control" wire:model="toDate">
                            </div>

                            <button type="button" wire:click="nextStep">Selanjutnnya</button>
                        </div>
                    @endif

                    @if($step == 2)
                        <div>
                            <h4>Step {{ $step }}. Tentukan Point</h4>

                            <div class="form-group">
                                <select class="form-control" wire:model="arrayPoints" multiple style="height: 10rem">
                                    @forelse($cities as $city)
                                        <optgroup label="[{{$city->code}}] {{$city->name}}">
                                            @forelse($city->points as $point)
                                                <option value="{{$point->id}}">[{{$point->code}}] {{$point->name}}</option>
                                            @empty

                                            @endforelse
                                        </optgroup>
                                    @empty

                                    @endforelse
                                </select>
                            </div>

                            @foreach($arrayPoints as $item)
                                <strong>{{ $points[$item]->name }}</strong> ->
                            @endforeach

                            <div class="form-group">
                                <label>Jumlah Point</label>
                                <input type="number" wire:model="countPoints" class="form-control">
                            </div>

                            @for($i = 0; $i < $countPoints; $i++ )
                                <div class="form-group">
                                    <label>Point {{ $i+1 }}</label>
                                    <select wire:model="arrayPoints.{{$i}}" wire:change="generateRoute" class="form-control">
                                        <option value="">pilih..</option>
                                        @forelse($cities as $city)
                                            <optgroup label="[{{$city->code}}] {{$city->name}}">
                                                @forelse($city->points as $point)
                                                    <option value="{{$point->id}}">[{{$point->code}}] {{$point->name}}</option>
                                                @empty

                                                @endforelse
                                            </optgroup>
                                        @empty

                                        @endforelse
                                    </select>
                                </div>

                            @endfor
                            <button type="button" class="btn btn-danger m-2" wire:click="resetPoint">Reset Point</button>

                            <button type="button" wire:click="previousStep">Sebelumna</button>
                            <button type="button" wire:click="nextStep">Selanjutnnya</button>
                        </div>
                    @endif

                    @if($step == 3)
                        <div>
                            <h4>Step {{ $step }}. Tentukan Harga</h4>

                            <div class="form-group">
                                <label>Harga Normal Tiket</label>
                                <input type="text" wire:model="price" class="form-control">
                            </div>

                            {{ json_encode($routes) }}

                            @forelse($routes as $index => $route)
                                <div class="form-group">
                                    <label>{{ $points[$route['from']]->name }} - {{ $points[$route['to']]->name }} : <strong>Rp. {{ $prices[$index] ?? 0}}</strong></label>
{{--                                    <input type="number" name="" class="form-control">--}}
                                </div>
                            @empty
{{--                                <h4>Tentukan point terlebih dahulu</h4>--}}
                            @endforelse

                            <button type="button" wire:click="previousStep">Sebelumna</button>
                            <button type="button" wire:click="nextStep">Selanjutnnya</button>
                        </div>
                    @endif

                    @if($step == 4)
                        <div>
                            <h4>Step {{ $step }}. Tentukan Jam Keberangkatan</h4>

                            <div class="form-group">
                                <label>Jumlah Jam Keberangkatan</label>
                                <input type="number" wire:model="countTimes" class="form-control">
                            </div>

                            <table class="table table-bordered w-50">
                                <thead class="thead-light">
                                <tr>
                                    @for($i = 0; $i < count($arrayPoints)-1; $i++ )
                                        <th>
                                            {{ $points[$arrayPoints[$i]]->name }}
                                        </th>
                                    @endfor
                                </tr>
                                </thead>

                                <tbody>
                                @for($i = 0; $i < $countTimes; $i++ )
                                    <tr>
                                        @for($j = 0; $j < count($arrayPoints)-1; $j++ )
                                            <td>
                                                <input type="number" wire:model="times.{{ $i }}.{{$arrayPoints[$j]}}.hour" class="w-50" placeholder="jam">
                                                <input type="number" wire:model="times.{{ $i }}.{{$arrayPoints[$j]}}.minute"  class="w-50" placeholder="menit">
                                            </td>
                                        @endfor
                                    </tr>
                                @endfor
                                </tbody>
                            </table>

                            {{ json_encode($times) }}



                            <button type="button" wire:click="previousStep">Sebelumnya</button>
                            <button type="button" wire:click="save">Simpan</button>
                        </div>
                    @endif

                </form>
            </div>
        </div>
    </div>
</div>
