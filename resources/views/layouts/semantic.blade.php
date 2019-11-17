@extends('layouts.base')

@section('template')
    {{-- header based on auth status --}}
    <header>
        {{-- Logo --}}
        <img id="header-logo" src="{{ route('assets.logo') }}" />

        {{-- Title and filters --}}
        @if(isset($show) && in_array($show, 'header_filters'))
            {{-- placeholder for filters that will replace the title --}}
        @else
            <h1 class="title">{{ config('app.name', 'P&N') }}</h1>
        @endif

        @if(Auth::check())
            {{-- Browse link --}}
        @else
            <a class="auth-link" href="{{-- Sign Up/Login route --}}">Sign Up/Login</a>
        @endif
    </header>

    <body>
        @yield('body')
    </body>

    <footer>
        {{-- Social media links (facebook, insta, twitter)--}}
        <div class="social-container">
            @foreach(config('icon.identifiers') as $identifier)
                <a href="{{ config('social.' . $identifier . '_url') . config('social.' . $identifier . '_username') }}" target="_blank"> 
                    <img src="{{ route('assets.icon', $identifier) }}"/>
                </a>
            @endforeach
        </div>
        
        {{-- copyright... --}}
        <p class="copyright">&copy; {{ config('app.name', 'P&N') }}</p>
    </footer>
@endsection