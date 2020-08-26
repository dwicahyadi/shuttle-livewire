@extends('layouts.reservation')

@section('content')
    <div class="container-fluid">
        <div class="row p-0">
            <div class="col-md-3 p-0 border-right bg-white" id="col1">
                <div class="sticky-top p-2 bg-primary border-top" style="height: 4rem;">
                    <div class="d-flex w-100 mx-auto justify-content-between">
                        <button type="button" class="btn btn-sm">
                            <img src="{{ asset('images/calendar (1).svg') }}" alt="new" width="18">
                            <br> Cari Jadwal
                        </button>

                        <button type="button" class="btn btn-sm">
                            <img src="{{ asset('images/receptionist.svg') }}" alt="new" width="18">
                            <br> Cari Reservasi
                        </button>
                    </div>

                </div>
                <div class="full-height bg-white">
                    <x-reservation.schedule-form id="form-schedule-search" />
                    <ul class="list-group" id="schedule-list">
                    </ul>
                </div>
            </div>

            <div class="col-md-5 p-0 border-right" id="col2">
                <div class="sticky-top p-2 bg-primary border-top" style="height: 4rem;">
                </div>
            </div>
            <div class="col-md-4 p-0" id="col3">
                <div class="sticky-top p-2 bg-primary border-top" style="height: 4rem;">
                </div>
                <input type="text" name="" id="form-status" value="new">

                <x-reservation.new-form />
            </div>

        </div>
    </div>
@endsection

@push('script')
    <script>
        function getDeparture(departure_id){
            $.ajax({
                url: '{{ route('ajax.getDeparture') }}',
                type: 'get',
                data: {departure_id: departure_id},
                success: function (result){
                    $('#col2').html(result);
                },
                error: function (error){
                    alert(error)
                }
            })
        }
    </script>
@endpush
