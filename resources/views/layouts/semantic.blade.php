@extends('layouts.base')

@section('template')
    {{-- header based on auth status --}}
    <header>
        <img id="header-logo" src="{{ route('assets.logo') }}" />
        @if(isset($show) && in_array($show, 'header_filters'))
            {{-- placeholder for filters that will replace the title --}}
        @else
            <h1 class="title">{{ config('app.name', 'P&N') }}</h1>
        @endif
    </header>

    <body>
        @yield('body')
    </body>

    <footer>
        {{-- copyright and contact info and social media links --}}
    </footer>
@endsection