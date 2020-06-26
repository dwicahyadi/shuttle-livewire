<div xmlns:wire="http://www.w3.org/1999/xhtml">
    <div class="container bg-white">
        <div class="row mt-4">
            <div class="col-md-12 animate__animated animate__fadeIn animate__fast">
                <h1 class="my-3"><strong>Jadwal</strong> . Kelola Jadwal</h1>
                <p>Kelola jadwal yang sudah dibuat</p>
            </div>
        </div>



        <div class="row p-2">
            <div class="col-md-3 p-0 bg-white border-right">
                <div class="bg-light text-center border border-right-0 p-2 sticky-top" style="height: 5rem;">
                    <div class="d-flex w-100 mx-auto justify-content-between">
                        <a href="{{ route('schedule.create') }}" class="btn btn-light">
                            <img src="{{ asset('images/calendar (1).svg') }}" alt="new" width="24">
                            <br> Buat Jadwal
                        </a>
                    </div>
                </div>
                <form class="p-2" wire:submit.prevent="findDepartures">
                    <div class="form-group">
                        {{--                        <label class="mx-2">Tanggal</label>--}}
                        <input type="date" wire:model.lazy="date" class="form-control">
                        @error('date')<br>{{ $message }}@enderror
                    </div>

                    <div class="form-group">
                        <div class="input-group">
                            <select class="form-control" wire:model.lazy="departurePointId" wire:change="setDeparturePoint">
                                <option value="">Berangkat dari</option>
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
                            <select class="form-control" wire:model.lazy="arrivalPointId" wire:change="setArrivalPoint">
                                <option value="">Tujuan</option>
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
                        <button type="button" class="btn btn-block" wire:click="switchPoint"  title="Klik untuk Switch Point"><i class="fa fa-exchange-alt"></i></button>
                    </div>
                    {{--  <div class="form-group">
                          <button type="submit" class="btn btn-primary btn-block">Cari</button>
                      </div>--}}
                </form>

                <ul class="list-group">
                    @forelse($departures as $departure)
                        <li class="list-group-item list-group-item-action @if($departure->is_open)

                        @else
                            bg-secondary
                        @endif @if($departure->id == $selectedDeparture['id']) bg-primary text-white @endif" wire:click="getDeparture({{$departure->id}})" wire:key="{{$departure->id}}">
                            <div class="d-flex">
                                <div class="mr-2">
                                    @if($departure->is_open)
                                        <i class="text-black-50 far fa-clock fa-2x mt-2"></i>
                                    @else
                                        <i class="text-black-50 far fa-window-close fa-2x mt-2"></i>
                                    @endif

                                </div>
                                <div class="flex-fill">
                                    <strong class="clearfix">{{ substr($departure->time, 0,5) }}</strong>
                                    <small class="text-muted">Note: {{ $departure->schedule->note }}</small>
                                </div>
                                <div>
                                    <label class="badge badge-success">{{ $departure->schedule->seats - $departure->tickets->count() }}</label>
                                </div>
                            </div>
                        </li>
                    @empty
                        <div class="col-md-12 p-4">
                            <h1 class="text-muted">Tidak ada keberangkatan</h1>
                        </div>
                    @endforelse
                </ul>
            </div>

            @isset($selectedDeparture)
                <div class="col-md-4 p-0 bg-white border-right animate__animated animate__fadeIn">
                    <div class="bg-light text-center border p-2 sticky-top" style="height: 5rem;">
                        <div class="d-flex w-100 mx-auto justify-content-between">
                            <button type="button" class="btn btn-light" wire:click="save">
                                <img src="{{ asset('images/news.svg') }}" alt="new" width="24">
                                <br> Simpan
                            </button>

                            <button type="button" class="btn btn-light" wire:click="toggleStatus({{ $selectedDepartureId }})">
                                <img src="{{ asset('images/key.svg') }}" alt="new" width="24">
                                <br> @if(!$selectedDeparture->is_open) Buka @else Tutup @endif
                            </button>
                        </div>
                    </div>

                    <div class="text-center p-2">
                        @if(!$selectedDeparture->is_open) <h1 class="text-danger">DITUTUP</h1> @endif
                        <h6 class="">{{ $selectedDeparture->code ?? '' }} </h6>
                        <h4 class="">{{ $selectedDeparture->departure_point->code ?? '---' }} <i class="fa fa-exchange-alt"></i> {{ $selectedDeparture->arrival_point->code ?? '---' }}</h4>
                        <h6 class="">{{ $selectedDeparture->date ?? '' }} {{ $selectedDeparture->time ?? '' }}</h6>
                    </div>


                    <form class="p-4" onsubmit="return false">

                        <div class="form-group">
                            <label>Mobil {{ $car_id }}</label>
                            <select class="form-control" wire:model="car_id">
                                <option value="">Pilih ..</option>
                                @forelse($cars as $car)
                                    <option value="{{ $car->id }}">{{ $car->code}} Nopol.{{ $car->license_number }}</option>
                                @empty

                                @endforelse
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Driver {{ $driver_id }}</label>
                            <select class="form-control" wire:model="driver_id">
                                <option value="">Pilih ..</option>
                                @forelse($drivers as $driver)
                                    <option value="{{ $driver->id }}">{{ $driver->name }}</option>
                                @empty

                                @endforelse
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Note</label>
                            <textarea class="form-control" wire:model="note"></textarea>
                        </div>
                    </form>
                </div>
            @endisset
        </div>
    </div>
</div>
