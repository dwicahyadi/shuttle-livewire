<div class="list-group list-group-flush">
    <a class="list-group-item list-group-item-action bg-dark text-center text-white" href="{{ route('reservation') }}"><i class="fa far fa-home"></i></a>
    <div class="dropdown">
        <a class="list-group-item list-group-item-action bg-dark text-center text-white dropdown-toggle" href="#" id="dropDownMaster" data-toggle="dropdown"
           aria-haspopup="true" aria-expanded="false"><i class="fa far fa-database"></i></a>
        <div class="dropdown-menu animate__animated animate__fadeIn animate__fast"  style="z-index: 9981">
            @can('City')<a class="dropdown-item" href="{{route('city')}}">Kota</a>@endcan
            @can('Point')<a class="dropdown-item" href="{{route('point')}}">Point</a>@endcan
            @can('Car')<a class="dropdown-item" href="{{route('car')}}">Mobil</a>@endcan
            @can('Driver')<a class="dropdown-item" href="{{route('driver')}}">Sopir</a>@endcan
            @can('Discount')<a class="dropdown-item" href="{{route('discount')}}">Diskon</a>@endcan
        </div>
    </div>

    <div class="dropdown">
        <a class="list-group-item list-group-item-action bg-dark text-center text-white dropdown-toggle" href="#" id="dropDownSchedule" data-toggle="dropdown"
           aria-haspopup="true" aria-expanded="false"><i class="fa far fa-calendar-alt"></i></a>
        <div class="dropdown-menu animate__animated animate__fadeIn animate__fast"  id="dropDownSchedule">
            <a class="dropdown-item" href="{{route('schedule.create')}}">Buka Jadwal</a>
            <a class="dropdown-item" href="{{route('schedule.manage')}}">Kelola Jadwal</a>
        </div>
    </div>

    <a class="list-group-item list-group-item-action bg-dark text-center text-white" href="{{ route('reservation') }}"><i class="fa far fa-ticket-alt"></i></a>

    <div class="dropdown">
        <a class="list-group-item list-group-item-action bg-dark text-center text-white dropdown-toggle" href="#" id="dropDownHistory" data-toggle="dropdown"
           aria-haspopup="true" aria-expanded="false"><i class="fa far fa-history"></i></a>
        <div class="dropdown-menu animate__animated animate__fadeIn animate__fast" >
            <a class="dropdown-item" href="{{route('history.reservation')}}">Reservasi</a>
            <a class="dropdown-item" href="{{route('history.transaction')}}">Transaksi</a>
            <a class="dropdown-item" href="{{route('history.settlement')}}">Settlement</a>
        </div>
    </div>


    <div class="dropdown">
        <a class="list-group-item list-group-item-action bg-dark text-center text-white dropdown-toggle" href="#" id="dropdwonSetting" data-toggle="dropdown"
           aria-haspopup="true" aria-expanded="false"><i class="fa far fa-cogs"></i></a>
        <div class="dropdown-menu animate__animated animate__fadeIn animate__fast" >
            <a class="dropdown-item" href="{{route('setting.user')}}">User</a>
        </div>
    </div>

    <div class="dropdown">
        <a class="list-group-item list-group-item-action bg-dark text-center text-white dropdown-toggle" href="#" id="dropdwonSetting" data-toggle="dropdown"
           aria-haspopup="true" aria-expanded="false"><i class="fa far fa-users"></i></a>
        <div class="dropdown-menu animate__animated animate__fadeIn animate__fast" >
            <a class="dropdown-item" href="{{route('setting.user')}}">User</a>
        </div>
    </div>

    <div class="dropdown">
        <a class="list-group-item list-group-item-action bg-dark text-center text-white dropdown-toggle" href="#" id="dropDownHistory" data-toggle="dropdown"
           aria-haspopup="true" aria-expanded="false"><i class="fa fa-file-alt"></i></a>
        <div class="dropdown-menu animate__animated animate__fadeIn animate__fast" >
            <a class="dropdown-item" href="{{route('report.ocupancy')}}">Okupansi</a>
            <a class="dropdown-item" href="{{route('report.income-statement')}}">Pendapatan</a>
            <a class="dropdown-item" href="{{route('report.settlements')}}">Settlement</a>
        </div>
    </div>
</div>


