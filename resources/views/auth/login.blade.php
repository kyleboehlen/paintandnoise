@extends('layouts.semantic')

@section('body')
    <div class="card">
        <br/><br/>
        <div class="card-header">Login</div><br/><br/>

        <div class="card-body">
            <form method="POST" action="{{ route('login') }}">
                @csrf

                    <label for="email">Email</label><br/>
                    <input id="email" type="email" class="@if($errors->any()) is-invalid @endif" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                    <br/>

                    <label for="password">Password</label><br/>
                    <input id="password" type="password" class="@if($errors->any()) is-invalid @endif" name="password" required autocomplete="current-password">
                    <br/>

                    <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label for="remember">Remember Me</label><br/>

                    @if($errors->any())
                        <span class="invalid-feedback" role="alert">
                            @foreach($errors->all() as $error)
                                <strong>{{ $error }}</strong>
                            @endforeach
                        </span>
                        <br/><br/>
                    @endif

                    <input type="submit" value="Login" /><br/><br/><br/><br/>

                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}">Forgot Password?</a><br/><br/>
                    @endif

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}">No Account? Sign Up.</a><br/><br/><br/>
                    @endif
            </form>
        </div>
    </div>
@endsection
