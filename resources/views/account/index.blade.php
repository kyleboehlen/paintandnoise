@extends('layouts.semantic')

@section('body')
    <div class="card">
        <br/><br/>
        <div class="card-header">Your Account</div><br/><br/>
    
        <div class="account-card-body">
                {{-- Update profile picture --}}
                <span class="account-profile-picture">
                    <img src="{{ route('assets.profile-picture') }}" />
                </span>

                <form id="profile-picture-form" action="{{ route('account.update.profile-picture') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <label class="account-profile-picture" for="profile-picture-input">
                        <img src="{{ route('assets.profile-picture') }}" />
                    </label><br/>
                    <input id="profile-picture-input" type="file" name="profile-picture" accept=".png,.jpg,.jpeg" required />
                    <br/><br/>

                    @error('profile-picture')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span><br/><br/>
                    @enderror

                    <input type="submit" name="update" value="Update" /><br/><br/>
                </form>

                {{-- Update name --}}
                <form id="name-form" action="{{ route('account.update.name') }}" method="POST">
                    @csrf

                    <label for="name">Name</label><br/>
                    <input id="name" type="text" class="@error('name') is-invalid @enderror" name="name" value="{{ $user->name }}" max="255" required>
                    <br/><br/>

                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span><br/>
                    @enderror
                    
                    <input id="account-name-submit" type="submit" value="Update" /><br/><br/>
                </form>

                {{-- Update categories --}}
                <a href="{{ route('account.categories') }}">Update Categories</a><br/><br/>

                {{-- NSFW Toggle --}}
                <a class="{{ $user->show_nsfw ? 'nsfw' : '' }}" href="{{ route('account.update.nsfw') }}"
                    onclick="event.preventDefault();
                        document.getElementById('nsfw-form').submit();">
                    NSFW Is {{ $user->show_nsfw ? 'On' : 'Off' }}
                </a><br/><br/>

                <form id="nsfw-form" action="{{ route('account.update.nsfw') }}" method="POST">
                    @csrf
                </form>

                {{-- Reset Password --}}
                @if(session('status'))
                    <div class="alert-success" role="alert">
                        {{ session('status') }}
                    </div><br/>
                @endif

                <a href="{{ route('account.update.password') }}"
                    onclick="event.preventDefault();
                        document.getElementById('password-form').submit();">
                    Reset Password</a><br/><br/>

                <form id="password-form" action="{{ route('account.update.password') }}" method="POST">
                    @csrf
                </form>

                {{-- Verified Poster Options --}}
        </div>
    </div>
@endsection