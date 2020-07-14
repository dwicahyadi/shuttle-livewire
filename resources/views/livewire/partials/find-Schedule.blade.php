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
