<div class="container-fluid">
    <div wire:loading class="animate__animated animate__fadeIn rounded bg-secondary text-center shadow text-white p-4" style="width: 10rem;
	height: 4rem;
	position: absolute;
	top:0;
	bottom: 0;
	left: 0;
	right: 0;
    z-index: 1000;
	margin: auto;">
        <strong>loading..</strong>
    </div>
    <div class="row p-0" style="min-height: 100%">
        <div class="col-md-3 p-0 bg-white border-right">
            <div class="bg-light text-center border border-right-0 p-2 sticky-top" style="height: 4rem;">
                <div class="d-flex w-100 mx-auto justify-content-between">
                    <button type="button" class="btn btn-light btn-sm" wire:click="$set('isFindTicket',0)">
                        <img src="{{ asset('images/calendar (1).svg') }}" alt="new" width="18">
                        <br> Cari Jadwal
                    </button>

                    <button type="button" class="btn btn-light btn-sm" wire:click="$set('isFindTicket',1)">
                        <img src="{{ asset('images/receptionist.svg') }}" alt="new" width="18">
                        <br> Cari Reservasi
                    </button>

                </div>


            </div>
            @livewire('reservation.partial.schedules')
        </div>


        <div class="col-md-4 p-0 bg-white border-right animate__animated animate__fadeIn">
            @livewire('reservation.partial.seat-layout')
        </div>
        <div class="col-md-5 p-0 bg-white animate__animated animate__fadeIn">
            @livewire('reservation.partial.reservation-form')

            @isset($selectedReservation)
                @include('livewire.partials.detail-reservation')
            @endisset
        </div>
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
                                <input type="number" class="form-control" wire:model="costs" required>
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
                    <h4>Konfirmasi pembayaran dengan sebesar</h4>
                    <h1><small>Rp.</small>{{ number_format( $subTotal ) }}</h1>
                    <select class="form-control-lg form-control" wire:model="paymentMethod">
                        <option value="CASH PAYMENT">CASH PAYMENT</option>
                        <option value="CARD PAYMENT">CARD PAYMENT</option>
                        <option value="ONLINE PAYMENT">ONLINE PAYMENT</option>
                    </select>
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
                    <h4>Konfirmasi pembayaran sebesar</h4>
                    <h1><small>Rp.</small>{{ number_format(isset($selectedReservation->tickets) ? $selectedReservation->tickets->sum('price') ?? 0 : 0) }}</h1>
                    <select class="form-control-lg form-control" wire:model="paymentMethod">
                        <option value="CASH PAYMENT">CASH PAYMENT</option>
                        <option value="CARD PAYMENT">CARD PAYMENT</option>
                        <option value="ONLINE PAYMENT">ONLINE PAYMENT</option>
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" data-dismiss="modal" wire:click="paymentOnly">Bayar</button>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade show" id="confirmCancel" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document" >
            <div class="modal-content modal-sm">
                <div class="modal-header">
                    <h5 class="modal-title">Konfirmasi Cancel</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h4>Yakin batalkan tiket?</h4>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                    <button type="button" class="btn btn-primary" data-dismiss="modal" wire:click="cancelTicket">Yakin</button>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade show" id="confirmManifest" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document" >
            <div class="modal-content modal">
                <div class="modal-header">
                    <h5 class="modal-title">Konfirmasi Cetak Manifest</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h4>Setelah cetak manifet:
                        <ul>
                            <li> Penumpang yang sudah bayar tidak dapat di-reschedule</li>
                            <li> Penumpang belum bayar dinyatakan "Dibatalkan"</li>
                        </ul>
                    </h4>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                    <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="window.open('{{ route('print.manifest', ['schedule'=> $selectedDeparture->schedule->id ?? 0]) }}', '', 'width=500,height=500')">Yakin</button>
                </div>
            </div>
        </div>
    </div>
</div>
