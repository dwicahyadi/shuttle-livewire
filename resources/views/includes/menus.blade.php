<ul class="navbar-nav mr-auto mt-2 mt-lg-0">
    <li class="nav-item active">
        <a class="nav-link" href="{{ route('reservation') }}">Home</a>
    </li>
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="dropDownMaster" data-toggle="dropdown"
           aria-haspopup="true" aria-expanded="false">Master</a>
        <div class="dropdown-menu animate__animated animate__fadeIn animate__fast" aria-labelledby="dropDownMaster" style="z-index: 9981">
            @can('City')<a class="dropdown-item" href="{{route('city')}}">Kota</a>@endcan
            @can('Point')<a class="dropdown-item" href="{{route('point')}}">Point</a>@endcan
            @can('Car')<a class="dropdown-item" href="{{route('car')}}">Mobil</a>@endcan
            @can('Driver')<a class="dropdown-item" href="{{route('driver')}}">Sopir</a>@endcan
            @can('Discount')<a class="dropdown-item" href="{{route('discount')}}">Diskon</a>@endcan
            @can('Discount')<a class="dropdown-item" href="{{route('discount')}}">Cutomer</a>@endcan
        </div>
    </li>
    @can('Schedule')
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="dropDownSchedule" data-toggle="dropdown"
               aria-haspopup="true" aria-expanded="false">Jadwal</a>
            <div class="dropdown-menu animate__animated animate__fadeIn animate__fast" aria-labelledby="dropDownSchedule">
                <a class="dropdown-item" href="{{route('schedule.create2')}}">Buka Jadwal</a>
                <a class="dropdown-item" href="{{route('schedule.manage')}}">Kelola Jadwal</a>
            </div>
        </li>
    @endcan

    @can('Reservation')
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="dropDownReservation" data-toggle="dropdown"
               aria-haspopup="true" aria-expanded="false">Reservasi</a>
            <div class="dropdown-menu animate__animated animate__fadeIn animate__fast" aria-labelledby="dropDownReservation">
                <a class="dropdown-item" href="{{route('reservation')}}">Buat Reservasi</a>
                <a class="dropdown-item" href="{{route('reservation.transfer_monitor')}}">Monitor Pembayaran Transfer</a>
            </div>
        </li>

        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="dropDownHistory" data-toggle="dropdown"
               aria-haspopup="true" aria-expanded="false">History</a>
            <div class="dropdown-menu animate__animated animate__fadeIn animate__fast" aria-labelledby="dropDownHistory">
                <a class="dropdown-item" href="{{route('history.reservation')}}">Reservasi</a>
                <a class="dropdown-item" href="{{route('history.transaction')}}">Transaksi</a>
                <a class="dropdown-item" href="{{route('history.settlement')}}">Settlement</a>
            </div>
        </li>
    @endcan

    @can('Setting')
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="dropdwonSetting" data-toggle="dropdown"
               aria-haspopup="true" aria-expanded="false">Setting</a>
            <div class="dropdown-menu animate__animated animate__fadeIn animate__fast" aria-labelledby="dropdwonSetting">
                <a class="dropdown-item" href="{{route('setting.user')}}">User</a>
            </div>
        </li>
    @endcan

    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="dropDownHistory" data-toggle="dropdown"
           aria-haspopup="true" aria-expanded="false">Laporan</a>
        <div class="dropdown-menu animate__animated animate__fadeIn animate__fast" aria-labelledby="dropDownHistory">
            <a class="dropdown-item" href="{{route('report.ocupancy')}}">Okupansi</a>
            <a class="dropdown-item" href="{{route('report.income-statement')}}">Pendapatan</a>
            <a class="dropdown-item" href="{{route('report.settlements')}}">Settlement</a>
        </div>
    </li>
</ul>
