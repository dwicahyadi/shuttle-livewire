<div>
    <div id="schedule-form-search" class="bg-light rounded-bottom">
        <form class="p-2 form-inline" id="form-schedule-search">
            <div class="form-group w-100 my-2">
                <label class="w-25">Tanggal</label>
                <input type="date" class="form-control w-75" name="date" value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}">
                @error('date')<br>{{ $message }}@enderror
            </div>

            <div class="form-group w-100 my-2">
                <label class="w-25">Asal</label>
                <select class="form-control w-75" name="departure_point_id" id="select-departure-point">
                    <option value=""></option>
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

            <div class="form-group w-100 my-2">
                <label class="w-25">Tujusn</label>
                <select class="form-control w-75" name="arrival_point_id" id="select-arrival-point">
                    <option value=""></option>
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

            <div class="form-group w-100 align-content-center">
                <div class="mt-2">
                    <div class="btn-group btn-block">
                        <button type="button" class="btn btn-primary" title="Klik untuk Switch Point" id="button-switch-point">
                            <i class="fa fa-exchange-alt"></i> <strong>Swithh Point</strong>
                        </button>
                        <button type="submit" class="btn btn-primary" title="Cari">
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
    </div>

    @push('script')
        <script>
            function disableSamePoint(){
                $('#select-arrival-point option[value="' + $('#select-departure-point').val() + '"]')
                    .attr('disabled', true)
                    .siblings().removeAttr('disabled');
            }
            function switchPoint(){
                var origin = $('#select-departure-point');
                var target = $('#select-arrival-point');
                var temp = target.val();

                $('#select-arrival-point option[value="' + origin.val() + '"]')
                    .removeAttr('disabled');

                target.val(origin.val());
                origin.val(temp);
                disableSamePoint();
            }
            function findSchedules(){
                $.ajax({
                    url: '{{ route(('ajax.findSchedules')) }}',
                    type: 'get',
                    data: $('#form-schedule-search').serialize(),
                    success: function (results){
                        $('#schedule-list').html(results);
                    }
                })
            }
            $('#select-departure-point').change(function() {
                disableSamePoint();
            });

            $('#button-switch-point').click(function (){
               switchPoint();
               findSchedules();
            });

            $('#form-schedule-search').submit(function (e){
                e.preventDefault();
                findSchedules();
            });
        </script>
    @endpush
</div>
