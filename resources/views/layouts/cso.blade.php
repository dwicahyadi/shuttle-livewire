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
        <main class="container-fluid p-0">
            <div class="d-flex">
                <div class="bg-dark flex-column">
                    <div class="text-center p-2 shadow-sm" style="height: 4rem;">
                        <img src="{{ asset('images/logo.svg') }}" alt="logo" class="img-fluid">
                    </div>
                    @include('includes.sidebar')

                    <button class="fixed-bottom btn btn-primary">Logout</button>
                </div>

                <div class="flex-fill">
                    @yield('content')
                </div>
            </div>

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
</body>
</html>
