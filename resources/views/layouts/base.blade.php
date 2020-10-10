<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'P&N') }}</title>

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>

        <!-- Styles -->
        <link href="@isset($stylesheet) {{ asset("css/$stylesheet.css") }} @else {{ asset('css/app.css') }} @endisset" rel="stylesheet">
        <link href="{{ asset('css/progress-bar.css') }}" rel="stylesheet">

        {{-- HTML5 Shiv --}}
        <!--[if lt IE 9]>
            <script src="bower_components/html5shiv/dist/html5shiv.js"></script>
        <![endif]-->
    </head>
        @yield('template')
</html>