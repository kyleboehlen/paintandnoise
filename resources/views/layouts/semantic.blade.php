@extends('layouts.base')

@section('template')
    <body>
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
                <h1 class="title">{{ config('app.name', 'P&N') }} @isset($secondary_title) {{ $secondary_title }} @endisset</h1>
            @endif

            @if(Auth::check())
                {{-- Log Out Button --}}
                @if(isset($show) && in_array('log_out_link', $show))
                    <a class="auth-link" href="{{ route('logout') }}" 
                        onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                        Log Out
                    </a>
                {{-- User Account Icon --}}
                @else
                    <a class="profile-link" href="{{ route('account') }}">
                        <img src="{{ route('assets.profile-picture') }}" />
                    </a>
                @endif
            @else
                @if(isset($show) && in_array('auth_link', $show))
                    <a class="auth-link" href="{{ route('login') }}">Sign Up/Login</a>
                @endif
            @endif
        </header>

        @yield('body')

        <footer>
            {{-- Social media links (facebook, insta, twitter)--}}
            <div class="social-container">
                @foreach(\App\Models\Socials\Socials::all() as $social)
                    @if(config()->has("social.$social->id"))
                        <a href="{{ $social->buildUrl(config("social.$social->id")) }}" target="_blank"> 
                            <img src="{{ route('assets.icon', $social->icon_identifier) }}"/>
                        </a>
                    @endif
                @endforeach
            </div>
            
            {{-- copyright... --}}
            <p class="copyright">&copy; {{ config('app.name', 'P&N') }}</p>
        </footer>
    </body>
@endsection