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
    <div id="app" class="bg-light" >
        <nav class="navbar navbar-expand-sm navbar-light bg-white">
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
                            <li class="nav-item">
                                <a href="" class="nav-link">
                                    <img src="{{ asset('images/wallet.svg') }}" width="16">
                                    <span class="text-primary">{{ session('bill') ?? 0 }}</span>
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
            @livewire('loading-state')
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
