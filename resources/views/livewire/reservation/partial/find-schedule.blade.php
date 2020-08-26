<div>
    <form class="p-2" wire:submit.prevent="find">
        <div class="form-group">
            <input type="date" wire:model.lazy="date" class="form-control">
            @error('date')<br>{{ $message }}@enderror
        </div>

        <div class="form-group mb-4">
            <div class="input-group">
                <select class="form-control" wire:model="departurePointId" wire:change="findArrivalPoints">
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
                <select class="form-control" wire:model="arrivalPointId">
                    <option value="">Tujuan</option>
                    @forelse($arrivalPoints as $city)
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
            <div class="mt-2">
                <div class="btn-group btn-block">
                    <button type="button" class="btn btn-light" wire:click="switchPoint"  title="Klik untuk Switch Point">
                        <i class="fa fa-exchange-alt"></i> <strong>Swithh Point</strong>
                    </button>
                    <button type="button" class="btn btn-light" wire:click="find"  title="Cari">
                        <i class="fa fa-search"></i> <strong>Cari</strong>
                    </button>
                </div>

            </div>

            <div class="mt-2">
                <label><input type="checkbox" wire:click="toggleonlyFilled" wire:model="onlyFilled"> Hanya tampilkan yang sudah terisi</label>
            </div>

        </div>
        {{--  <div class="form-group">
              <button type="submit" class="btn btn-primary btn-block">Cari</button>
          </div>--}}
    </form>
    <ul class="list-group" id="list-schedules">
        @forelse($departures as $i => $departure)
            @if($onlyFilled)
                @continue(!$departure->tickets_count)
            @endif

            <li class="list-group-item animate__animated animate__zoomIn animate__delay{{ $i }}" wire:click="selectDeparture({{ $departure->id }})">
                <div class="d-flex">
                    <strong class="flex-fill">{{ $departure->time }}</strong>
                    Tersedia :{{ $departure->schedule->seats - $departure->schedule->count_tickets }}
                </div>
                <div>
                    <small>Note: {{ $departure->schedule->note }}</small>
                </div>

            </li>
        @empty
            <div class="col-md-12 p-4">
                <h1 class="text-muted">Tidak ada keberangkatan</h1>
            </div>
        @endforelse
    </ul>


</div>
