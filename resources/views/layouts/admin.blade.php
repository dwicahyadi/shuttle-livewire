<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
{{--    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">--}}

    <link href="https://fonts.googleapis.com/css?family=Karla:400,700&display=swap" rel="stylesheet">
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>


    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/bd-wizard.css')}}">
    <link rel="stylesheet" href="{{asset('css/custom.css')}}">
    @livewireStyles
</head>
<body>
    <div id="app" class="bg-c-blue" >
        <nav class="navbar navbar-expand-sm navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="#">
                    <img src="{{asset('images/logo_surya_2.png')}}" alt="logo">
                </a>
                <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse"
                        data-target="#collapsibleNavId" aria-controls="collapsibleNavId"
                        aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="collapsibleNavId">
                    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                        <li class="nav-item active">
                            <a class="nav-link" href="#">Home</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="dropDownMaster" data-toggle="dropdown"
                               aria-haspopup="true" aria-expanded="false">Master</a>
                            <div class="dropdown-menu animate__animated animate__bounceIn animate__fast" aria-labelledby="dropDownMaster">
                                <a class="dropdown-item" href="{{route('city')}}">Kota</a>
                                <a class="dropdown-item" href="{{route('point')}}">Point</a>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="dropDownSchedule" data-toggle="dropdown"
                               aria-haspopup="true" aria-expanded="false">Jadwal</a>
                            <div class="dropdown-menu animate__animated animate__bounceIn animate__fast" aria-labelledby="dropDownSchedule">
                                <a class="dropdown-item" href="{{route('schedule.create')}}">Buka Jadwal</a>
                                <a class="dropdown-item" href="{{route('point')}}">Kelola Jadwal</a>
                            </div>
                        </li>

                        <li class="nav-item active">
                            <a class="nav-link" href="{{ route('reservation') }}">Reservasi</a>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="dropDownHistory" data-toggle="dropdown"
                               aria-haspopup="true" aria-expanded="false">History</a>
                            <div class="dropdown-menu animate__animated animate__bounceIn animate__fast" aria-labelledby="dropDownHistory">
                                <a class="dropdown-item" href="{{route('history.reservation')}}">Reservasi</a>
                                <a class="dropdown-item" href="{{route('history.transaction')}}">Transaksi</a>
                                <a class="dropdown-item" href="{{route('point')}}">Transaksi</a>
                            </div>
                        </li>
                    </ul>

                    <ul class="navbar-nav ml-auto text">

                        @guest

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link py-0" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item">
                                <a href="" class="nav-link">
                                    <img src="{{ asset('images/wallet.svg') }}" width="16">
                                    <span class="text-primary">20.000</span>
                                </a>
                            </li>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}  <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <span class="dropdown-divider"></span>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest

                    </ul>
                </div>
            </div>
        </nav>



        <main class="container-fluid">
            @yield('content')
        </main>


        <footer class="border-top py-4">
            <div class="container text-right">
                <img src="{{asset('images/logo.svg')}}" alt="logo"><br>
                <strong>{{config('settings.company_name')}}</strong><br>
                <small>{{config('settings.company_tagline')}}</small>
            </div>
        </footer>
    </div>

    @livewireScripts
</body>
</html>
