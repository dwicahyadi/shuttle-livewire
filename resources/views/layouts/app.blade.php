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
    <script src="https://unpkg.com/darkmode-js@1.3.4/lib/darkmode-js.js"></script>
    <script>
        const darkmode = new Darkmode();
        darkmode.showWidget();
    </script>


    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/bd-wizard.css')}}">
    <link rel="stylesheet" href="{{asset('css/custom.css')}}">
    <style>
        html, body {
            height: 100%;
        }

        .reservation-container {
            min-height: 100%;
            overflow: hidden;
        }

        #col1, #col2, #col3 {
            margin-bottom: -9999px;
            padding-bottom: 9999px;
        }
    </style>
    @livewireStyles
</head>
<body>
    <div id="app" class="bg-light" >
        <nav class="navbar navbar-expand-sm navbar-light bg-white">
            <div class="container">
                <a class="navbar-brand" href="#">
                    <img src="{{ config('settings.company_logo') ?? asset('images/logo.svg') }}" alt="logo">
                </a>
                <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse"
                        data-target="#collapsibleNavId" aria-controls="collapsibleNavId"
                        aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="collapsibleNavId">
                    @guest
                    @else
                        @include('includes.menus')
                    @endguest

                    <ul class="navbar-nav ml-auto text">

                        @guest
                            <li class="nav-item">
                                <a class="nav-link py-0" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                        @else
                            @can('Reservation')
                            <li class="nav-item">
                                <a href="{{route('settlment')}}" class="nav-link">
                                    @livewire('navbar.bill')
                                </a>
                            </li>
                            @endcan
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}  <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a href="{{ route('profile') }}" class="dropdown-item">Profile</a>
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



        <main class="container-fluid p-0">
            @livewire('loading-state')
            @yield('content')
        </main>


    {{--    <footer class="border-top py-4">
            <div class="container text-right">
                <img src="{{ config('settings.company_logo') ?? asset('images/logo.svg') }}" alt="logo"><br>
                <strong>{{config('settings.company_name')}}</strong><br>
                <small>{{config('settings.company_address')}}</small>
            </div>
        </footer>--}}
    </div>

    @livewireScripts
    @yield('script')
</body>
</html>
