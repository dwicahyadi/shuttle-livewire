<div class="container">
    <div class="row p-0" style="min-height: 50rem">
        <div class="col-md-3 p-0 bg-white border-right">
            <div class="bg-light text-center border pt-2" style="height: 5rem;">
                <div class="d-flex w-100 mx-auto justify-content-between">
                    <button type="button" class="btn btn-light" wire:click="$set('isFindTicket',0)">
                        <img src="{{ asset('images/calendar (1).svg') }}" alt="new" width="32">
                        <br> Cari Jadwal
                    </button>

                    <button type="button" class="btn btn-light" wire:click="$set('isFindTicket',1)">
                        <img src="{{ asset('images/receptionist.svg') }}" alt="new" width="32">
                        <br> Cari Reservasi
                    </button>

                </div>
            </div>
            @if($isFindTicket)
                @include('livewire.partials.find-ticket')
            @else
                @include('livewire.partials.find-Schedule')
            @endif
        </div>
        @isset($selectedDeparture)
            <div class="col-md-4 p-0 bg-white border-right animate__animated animate__fadeIn">
                <div class="bg-light text-center border pt-2" style="height: 5rem;">
                    @isset($selectedDeparture)
                        <div class="d-flex w-100 mx-auto justify-content-between">
                            <button type="button" class="btn btn-light" wire:click="$set('isManifestForm',1)">
                                <img src="{{ asset('images/news.svg') }}" alt="new" width="32">
                                <br> Manifest
                            </button>
                            <button type="button" class="btn btn-light" wire:click="$set('isManifestForm',1)">
                                <img src="{{ asset('images/rocket.svg') }}" alt="new" width="32">
                                <br> Berangkatkan
                            </button>
                            <button type="button" class="btn btn-light" title="Refresh" wire:click="$refresh">
                                <img src="{{ asset('images/reload.svg') }}" alt="new" width="32">
                                <br> Reload
                            </button>
                        </div>
                    @endisset
                </div>

                @isset($selectedDeparture)

                    <div class="text-center">
                        <h6 class="">{{ $selectedDeparture->code ?? '' }} </h6>
                        <h4 class="">{{ $selectedDeparture->departure_point->code ?? '---' }} <i class="fa fa-exchange-alt"></i> {{ $selectedDeparture->arrival_point->code ?? '---' }}</h4>
                        <h6 class="">{{ $selectedDeparture->date ?? '' }} {{ $selectedDeparture->time ?? '' }}</h6>

                    </div>
                    @include('livewire.partials.seats-layout')
                @endisset
            </div>
            <div class="col-md-5 p-0 bg-white animate__animated animate__fadeIn">
                <div class="bg-light text-center border pt-2" style="height: 5rem;">
                    @isset($selectedReservation)
                        @php($paid = $selectedReservation->tickets[0]->payment_by ?? 0)
                        <div class="d-flex w-100 mx-auto justify-content-between">
                            <button type="button" class="btn btn-light" data-toggle="modal" data-target="#confirmPayment" @if($paid) style="display: none" @endif>
                                <img src="{{ asset('images/pay.svg') }}" alt="new" width="32">
                                <br> Bayar
                            </button>

                            <button type="button" class="btn btn-light" onclick="window.open('{{ route('print.ticket', ['reservation'=> $selectedReservation]) }}', '', 'width=500,height=500')" @if(!$paid) style="display: none" @endif>
                                <img src="{{ asset('images/print.svg') }}" alt="new" width="32">
                                <br> Cetak
                            </button>

                            <button type="button" class="btn btn-light" wire:click="resetReservation">
                                <img src="{{ asset('images/watch.svg') }}" alt="new" width="32">
                                <br> Mutasi
                            </button>
                            <button type="button" class="btn btn-light" wire:click="cancelReservation" @if($paid) style="display: none" @endif>
                                <img src="{{ asset('images/trash.svg') }}" alt="new" width="32">
                                <br> Batalkan
                            </button>

                            <button type="button" class="btn btn-light">
                                <img src="{{ asset('images/share.svg') }}" alt="new" width="32">
                                <br> Bagikan
                            </button>

                            <button type="button" class="btn btn-light" wire:click="resetReservation">
                                <img src="{{ asset('images/add.svg') }}" alt="new" width="32">
                                <br>Baru
                            </button>
                        </div>
                    @else
                        <button type="button" class="btn btn-light" wire:click="resetReservation">
                            <img src="{{ asset('images/add.svg') }}" alt="new" width="32">
                            <br>Baru
                        </button>
                    @endisset
                </div>
                @if($isNew)
                    @include('livewire.partials.new-form')
                @endif

                @isset($selectedReservation)
                    @include('livewire.partials.detail-reservation')
                @endisset
            </div>
        @else
            <div class="col-md-9 bg-white animate__animated animate__fadeIn">
                <img src="{{ asset('images/receptionist.jpg') }}" alt="img" class="img-fluid m-4">
            </div>
        @endisset
    </div>

    @if($isManifestForm)
        <div class="modal d-block" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-sm">
                <div class="modal-content rounded shadow-lg">
                    <div class="modal-header">
                        <h4 class="modal-title">Manifest</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" wire:click="$set('isManifestForm',0)">×</button>
                    </div>
                    <div class="modal-body">
                        <form onsubmit="return false">

                            <div class="form-group">
                                <label>Mobil</label>
                                <select class="form-control" wire:model="car_id">
                                    <option value="">Pilih ..</option>
                                    @forelse($cars as $car)
                                        <option value="{{ $car->id }}">{{ $car->code}} Nopol.{{ $car->license_number }}</option>
                                    @empty

                                    @endforelse
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Driver</label>
                                <select class="form-control" wire:model="driver_id">
                                    <option value="">Pilih ..</option>
                                    @forelse($drivers as $driver)
                                        <option value="{{ $driver->id }}">{{ $driver->name }}</option>
                                    @empty

                                    @endforelse
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Kas Jalan</label>
                                <input type="number" class="form-control" required>
                            </div>
                            <hr>
                            <button type="submit" wire:click="saveManifest" class="btn btn-primary btn-lg">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif


    @if($isPrint)
        <div class="modal d-block" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content rounded shadow-lg">
                    <div class="modal-header">
                        <h4 class="modal-title">Cetak manifest</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" wire:click="$set('isManifestForm',0)">×</button>
                    </div>
                    <div class="modal-body print-area">
                        <h1>Print area</h1>
                    </div>
                    <div class="modal-footer">
                        <button type="button" onclick="window.print()"> Cetak</button>
                    </div>
                </div>
            </div>
        </div>
@endif

<!-- Modal -->
    <div class="modal fade show" id="confirmSaveAndPayment" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document" >
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Konfirmasi Simpan dan Bayar</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">N
                    <h4>Konfirmasi pembayaran dengan Tunai sebesar</h4>
                    <h1><small>Rp.</small>{{ number_format( $subTotal ) }}</h1>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" data-dismiss="modal" wire:click="saveAndPayment">Simpan dan Bayar</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade show" id="confirmPayment" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document" >
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Konfirmasi Pembayaran</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h4>Konfirmasi pembayaran dengan Tunai sebesar</h4>
                    <h1><small>Rp.</small>{{ number_format(isset($selectedReservation->tickets) ? $selectedReservation->tickets->sum('price') ?? 0 : 0) }}</h1>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" data-dismiss="modal" wire:click="paymentOnly">Bayar</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function printDiv() {
            var divToPrint = document.getElementById('print-area');
            newWin = window.open("");
            newWin.document.write(divToPrint.outerHTML);
            newWin.print();
        }
    </script>
</div>
