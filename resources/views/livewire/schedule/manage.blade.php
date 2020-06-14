<div xmlns:wire="http://www.w3.org/1999/xhtml">
    <div class="container">
        <div class="row mt-4">
            <div class="col-md-12 animate__animated animate__fadeIn animate__fast">
                <h1 class="my-3"><strong>Jadwal</strong> . Kelola Jadwal</h1>
                <p>Kelola jadwal yang sudah dibuat</p>
            </div>
        </div>

        <div class="row  p-2" style="z-index: 999; height: 5rem">
            <div class="cl-md-12 mx-auto">
                <form class="form-inline" wire:submit.prevent="findDepartures">
                    <div class="form-group border-right pr-2">
                        {{--                        <label class="mx-2">Tanggal</label>--}}
                        <input type="date" wire:model.lazy="date" class="form-control form-control-lg">
                        @error('date')<br>{{ $message }}@enderror
                    </div>

                    <div class="form-group">
                        <select class="form-control form-control-lg" wire:model.lazy="departurePointId" wire:change="setDeparturePoint">
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
                        @error('departurePointId')<br>{{ $message }}@enderror
                    </div>
                    <div class="form-group">
                        <label class="mx-2" wire:click="switchPoint"><i class="fa fa-exchange-alt"></i></label>
                    </div>
                    <div class="form-group">
                        <select class="form-control form-control-lg" wire:model.lazy="arrivalPointId" wire:change="setArrivalPoint">
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
                        @error('arrivalPointId')<br>{{ $message }}@enderror
                    </div>
                    <button type="submit" class="btn btn-primary m-2">Cari</button>
                </form>
            </div>
        </div>

        <div class="row">
            @forelse($departures as $departure)

                <div class="card my-2 col-md-3 shadow-sm m-1 @if(!$departure->is_open) bg-c-pink @endif" wire:key="{{ $departure->id }}">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <img src="{{ asset('images/calendar.svg') }}" class="img-fluid w-25 mr-2">
                            <div class="flex-fill">
                                <h5>{{ substr($departure->time, 0,5) }}</h5>
                            </div>
                            <span class="text-black-50"><i class="fas fa-users"></i> {{ $departure->tickets->count() }}</span>
                        </div>
                        <div class="d-flex justify-content-end">
                            <label><input type="checkbox" @if($departure->is_open) checked @endif wire:click="toggleStatus({{ $departure->id }})"> Dibuka</label>
                        </div>

                    </div>
                </div>
            @empty
                <div class="col-md-12 p-4">
                    <h2 class="text-muted">Tidak ada keberangkatan</h2>
                    <h4>Buka jadwal <a href="{{ route('schedule.create') }}">baru di sini</a></h4>
                </div>
            @endforelse
        </div>
    </div>
</div>
