@extends('layouts.base')

@section('template')
    {{-- Logout Form --}}
    @if(Auth::check())
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    @endif

    {{-- header based on auth status --}}
    <header>
        {{-- Logo --}}
        <a href="{{ route('root') }}">
            <img id="header-logo" src="{{ route('assets.logo') }}" />
        </a>

        {{-- Title and filters --}}
        @if(isset($show) && in_array('header_filters', $show))
            {{-- placeholder for filters that will replace the title --}}
        @else
            <h1 class="title">{{ config('app.name', 'P&N') }}</h1>
        @endif

        @if(Auth::check())
            {{-- Logout button for now, needs to be moved to user account page --}}
            <a class="profile-link" href="" 
                onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                <img src="{{ route('assets.profile-picture') }}" />
            </a>
        @else
            @if(isset($show) && in_array('auth_link', $show))
                <a class="auth-link" href="{{ route('login') }}">Sign Up/Login</a>
            @endif
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