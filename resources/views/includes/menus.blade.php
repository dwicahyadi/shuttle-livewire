<ul class="navbar-nav mr-auto mt-2 mt-lg-0">
    <li class="nav-item active">
        <a class="nav-link" href="#">Home</a>
    </li>
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="dropDownMaster" data-toggle="dropdown"
           aria-haspopup="true" aria-expanded="false">Master</a>
        <div class="dropdown-menu animate__animated animate__fadeIn animate__fast" aria-labelledby="dropDownMaster">
            <a class="dropdown-item" href="{{route('city')}}">Kota</a>
            <a class="dropdown-item" href="{{route('point')}}">Point</a>
            <a class="dropdown-item" href="{{route('car')}}">Mobil</a>
            <a class="dropdown-item" href="{{route('driver')}}">Sopir</a>
            <a class="dropdown-item" href="{{route('discount')}}">Diskon</a>
        </div>
    </li>
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="dropDownSchedule" data-toggle="dropdown"
           aria-haspopup="true" aria-expanded="false">Jadwal</a>
        <div class="dropdown-menu animate__animated animate__fadeIn animate__fast" aria-labelledby="dropDownSchedule">
            <a class="dropdown-item" href="{{route('schedule.create')}}">Buka Jadwal</a>
            <a class="dropdown-item" href="{{route('schedule.manage')}}">Kelola Jadwal</a>
        </div>
    </li>

    <li class="nav-item active">
        <a class="nav-link" href="{{ route('reservation') }}">Reservasi</a>
    </li>

    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="dropDownHistory" data-toggle="dropdown"
           aria-haspopup="true" aria-expanded="false">History</a>
        <div class="dropdown-menu animate__animated animate__fadeIn animate__fast" aria-labelledby="dropDownHistory">
            <a class="dropdown-item" href="{{route('history.reservation')}}">Reservasi</a>
            <a class="dropdown-item" href="{{route('history.transaction')}}">Transaksi</a>
            <a class="dropdown-item" href="{{route('point')}}">Transaksi</a>
        </div>
    </li>

    <li class="nav-item active">
        <a class="nav-link" href="{{ route('settlment') }}">Settlement</a>
    </li>
</ul>
