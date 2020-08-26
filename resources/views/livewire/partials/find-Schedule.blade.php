<form class="p-2" wire:submit.prevent="findDepartures">
    <div class="form-group">
        {{--                        <label class="mx-2">Tanggal</label>--}}
        <input type="date" wire:model.lazy="date" class="form-control" wire:change="findDepartures">
        @error('date')<br>{{ $message }}@enderror
    </div>

    <div class="form-group mb-4">
        <div class="input-group">
            <select class="form-control" wire:model="departurePointId" wire:change="findDepartures">
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
            <select class="form-control" wire:model="arrivalPointId" wire:change="findDepartures">
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
        <div class="mt-2">
            <button type="button" class="btn btn-block btn-outline-primary mt-2" wire:click="switchPoint"  title="Klik untuk Switch Point">
                <i class="fa fa-exchange-alt"></i> Swithh Point
            </button>
        </div>

        <div class="mt-2">
            <label><input type="checkbox" wire:click="toggleonlyFilled" wire:model="onlyFilled"> Hanya tampilkan yang sudah terisi</label>
        </div>

    </div>
    {{--  <div class="form-group">
          <button type="submit" class="btn btn-primary btn-block">Cari</button>
      </div>--}}
</form>

<ul class="list-group">
    @forelse($departures as $departure)
        @if($onlyFilled)
            @continue(!$departure->tickets_count)
        @endif

        <li class="list-group-item list-group-item-action @if($departure->id == $selectedDeparture['id']) bg-primary text-white @endif" wire:click="getDeparture({{$departure->id}})" wire:key="{{$departure->id}}">
            <div class="d-flex">
                <div class="mr-2">
                    <i class="text-black-50 far fa-clock fa-2x mt-2"></i>
                </div>
                <div class="flex-fill">

                    <strong class="clearfix">{{ substr($departure->time, 0,5) }}</strong>
                    <small class="text-muted">Note: {{ $departure->schedule->note }}</small>
                </div>
                <div>
                    <label class="badge badge-success">{{ $departure->schedule->seats - $departure->schedule->tickets_count }}</label>
                </div>
            </div>
        </li>
    @empty
        <div class="col-md-12 p-4">
            <h1 class="text-muted">Tidak ada keberangkatan</h1>
        </div>
    @endforelse
</ul>
