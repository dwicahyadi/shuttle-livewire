<div class="container-fluid" xmlns:wire="http://www.w3.org/1999/xhtml">
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
    <div class="row p-0">
        <div class="col-md-3 p-0 bg-white">
            <div class="shadow-sm sticky-top p-2 bg-white border-top" style="height: 4rem;">
                <div class="d-flex w-100 mx-auto justify-content-between">
                    <button type="button" class="btn btn-sm" wire:click="$set('isFindTicket',0)">
                        <img src="{{ asset('images/calendar (1).svg') }}" alt="new" width="18">
                        <br> Cari Jadwal
                    </button>

                    <button type="button" class="btn btn-sm" wire:click="$set('isFindTicket',1)">
                        <img src="{{ asset('images/receptionist.svg') }}" alt="new" width="18">
                        <br> Cari Reservasi
                    </button>

                </div>

            </div>
            <div class=""  style="height: 90vh; overflow: auto;">
                @livewire('reservation.partial.find-schedule')
            </div>
        </div>

        <div class="col-md-5 p-0 bg-white">
            @livewire('reservation.partial.departure-layout',['departureId'=>0])
        </div>
        <div class="col-md-4 p-0 bg-white">
            @livewire('reservation.partial.form')
        </div>
    </div>

    <script>
        document.addEventListener("livewire:load", function(event) {
            window.livewire.on('selectDeparture', data => {
                var element = document.getElementById('layout');
                if (element){
                    element.innerHTML = '';
                }
            });

            window.livewire.on('find', data => {
                alert('find')
            })

        });
    </script>

</div>
