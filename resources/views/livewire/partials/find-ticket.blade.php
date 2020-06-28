<input type="text" wire:model="search" class="form-control-lg form-control" placeholder="Cari nama atau no telepon">

<div style="height: 40rem; overflow-y: scroll">
    <ul class="list-group">
        @forelse($searchReults as $searchResult)
            <li class="list-group-item list-group-item-action @if($searchResult->is_cancel) text-danger @endif  @if($searchResult->reservation_id == ($selectedReservation->id ?? 0)) bg-primary  text-white @endif"
                @if($searchResult->is_cancel) wire:click="getFromSearch({{ $searchResult->id }})"  @else wire:click="getFromSearch({{ $searchResult->id }})"  @endif

                wire:key="{{$searchResult->id}}">
                <div class="d-flex">
                    @if($searchResult->is_cancel)
                        <img src="{{ asset('images/trash.svg') }}" alt="new" width="32" class="mr-2">
                    @else
                        <img src="{{ asset('images/ticket.svg') }}" alt="new" width="32" class="mr-2">
                    @endif
                    <div class="flex-fill">
                        <strong>{!!  str_ireplace($search,'<span class="bg-warning">'.$search.'</span>', $searchResult->name) !!}</strong> <span class="clearfix">{!!  str_ireplace($search,'<span class="bg-warning">'.$search.'</span>', $searchResult->phone) !!}</span>
                        <h5>{{ $transaction->departure->departure_point->code ?? '' }} - {{ $transaction->departure->departure_point->code ?? '' }} Seat <strong>{{ $searchResult->seat }}</strong></h5>
                        <span class="clearfix">{{ $searchResult->departure->date ?? '' }} <strong>{{ $searchResult->departure->time ?? '' }}</strong></span>
                    </div>
                </div>
            </li>
        @empty
            <div class="col-md-12 p-4">
                <h1 class="text-muted">Tidak ditemukan</h1>
            </div>
        @endforelse
    </ul>
</div>
