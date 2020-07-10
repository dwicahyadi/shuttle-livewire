<div>
    <div class="bg-light text-center border p-2 sticky-top" style="height: 4rem;">
        @isset($selectedReservation)
            @php($paid = $selectedReservation->tickets[0]->payment_by ?? 0)
            <div class="d-flex w-100 mx-auto justify-content-between">
                <button type="button" class="btn btn-light btn-sm" data-toggle="modal" data-target="#confirmPayment" @if($paid) style="display: none" @endif>
                    <img src="{{ asset('images/pay.svg') }}" alt="new" width="18">
                    <br> Bayar
                </button>

                <button type="button" class="btn btn-light btn-sm" wire:click="$refresh" onclick="window.open('{{ route('print.ticket', ['reservation'=> $selectedReservation]) }}', '', 'width=500,height=500')" @if(!$paid) style="display: none" @endif>
                    <img src="{{ asset('images/print.svg') }}" alt="new" width="18">
                    <br> Cetak <span class="badge badge-danger">{{ $selectedReservation->tickets[0]->count_print }}</span>
                </button>

                <button type="button" class="btn btn-light btn-sm" wire:click="resetReservation" hidden>
                    <img src="{{ asset('images/watch.svg') }}" alt="new" width="18">
                    <br> Mutasi
                </button>

                @if($selectedTickets)
                    <button type="button" class="btn btn-danger animate__animated animate__fadeIn" data-toggle="modal" data-target="#confirmCancel" @if($paid) style="display: none" @endif>
                        <img src="{{ asset('images/trash.svg') }}" alt="new" width="18">
                        <br> Batalkan
                    </button>
                @endif

                @can('Cancel Payment')
                    <button type="button" class="btn btn-danger animate__animated animate__fadeIn"  @if(!$paid) style="display: none" @endif wire:click="cancelPayment">
                        <img src="{{ asset('images/trash.svg') }}" alt="cancel" width="18">
                        <br> Batalkan Payment
                    </button>
                @endcan

                <button type="button" class="btn btn-light btn-sm" onclick="window.open('{{ 'https://'.$selectedReservation->short_url ?? 'https://suryashuttle.com' }}', '', 'width=800,height=600')">
                    <img src="{{ asset('images/share.svg') }}" alt="new" width="18">
                    <br> Bagikan
                </button>

                <button type="button" class="btn btn-light btn-sm" wire:click="resetReservation">
                    <img src="{{ asset('images/add.svg') }}" alt="new" width="18">
                    <br> Baru
                </button>
            </div>
        @else
            @if($isNew)
                <div class="d-flex w-100 mx-auto justify-content-between">
                    <button type="button" class="btn btn-light btn-sm" wire:click="saveOnly">
                        <img src="{{ asset('images/add.svg') }}" alt="new" width="18">
                        <br> Simpan
                    </button>

                    <button type="submit"  data-toggle="modal" data-target="#confirmSaveAndPayment"class="btn btn-light btn-sm">
                        <img src="{{ asset('images/pay.svg') }}" alt="new" width="18">
                        <br> Bayar
                    </button>
                </div>
            @endif
        @endisset


    </div>
    @error('phone')  @enderror

</div>
