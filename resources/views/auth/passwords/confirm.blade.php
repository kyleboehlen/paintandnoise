@extends('layouts.semantic')

@section('body')
    <div class="card">
        <br/>
        <div class="card-header">Confirm Password</div>

        <div class="card-body">
            <p>It's been a sec, please confirm it's still @if(\Auth::check()){{ \Auth::user()->name }}@else you @endif</p>

            <form method="POST" action="{{ route('password.confirm') }}">
                @csrf
                
                <label for="password">Password</label><br/>
                <input id="password" type="password" class="@error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                <br/><br/>

                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span><br/><br/>
                @enderror

                <input id="confirm-password-submit" type="submit" value="Confirm Password" /><br/><br/><br/><br/>

                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}">Forgot Password?</a><br/><br/>
                @endif
            </form>
        </div>
    </div>
@endsection
