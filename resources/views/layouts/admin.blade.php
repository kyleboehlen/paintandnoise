@extends('layouts.base')

@section('template')
    <body>
        {{-- Logout Form --}}
        @if(Auth::guard('admin')->check())
            <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        @endif

        {{-- header based on auth status --}}
        <header>
            {{-- Logo --}}
            <a href="{{ route('root') }}">
                <img id="header-logo" src="{{ route('assets.logo') }}" />
            </a>

            {{-- Title --}}
            <h1 class="title">Admin</h1>

            @if(Auth::guard('admin')->check())
                {{-- Log Out Button --}}
                <a class="auth-link" href="{{ route('admin.logout') }}" 
                    onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                    Abort
                </a>
            @endif
        </header>

        @yield('body')

    </body>
@endsection