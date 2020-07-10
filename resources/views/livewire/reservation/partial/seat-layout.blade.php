<div>

    @isset($selectedDeparture)
        <div class="bg-light text-center border p-2 sticky-top" style="height: 4rem;">
            <div class="d-flex w-100 mx-auto justify-content-between">
                <button type="button" class="btn btn-light btn-sm" data-toggle="modal" data-target="#confirmManifest">
                    <img src="{{ asset('images/news.svg') }}" alt="new" width="18">
                    <br> Manifest
                </button>

                <button type="button" class="btn btn-light btn-sm" title="Refresh" wire:click="$refresh">
                    <img src="{{ asset('images/reload.svg') }}" alt="new" width="18">
                    <br> Reload
                </button>
            </div>
        </div>

        <div class="text-center p-2">
            <h6 class="">{{ $selectedDeparture->code ?? '' }} </h6>
            <h4 class="">
                {{ $selectedDeparture->departure_point->code ?? '---' }}
                <i class="fa fa-arrow-right   "></i>
                {{ $selectedDeparture->arrival_point->code ?? '---' }} |
                {{ $selectedDeparture->date ?? '' }} |
                <strong class="text-info">{{ $selectedDeparture->time ?? '' }}</strong>
            </h4>

        </div>
        @include('livewire.partials.seats-layout')
    @endisset

</div>
