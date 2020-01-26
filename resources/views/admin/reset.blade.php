@extends('layouts.admin')

@section('body')
    <div class="card">
        <br/>
        <div class="card-header">Reset Password</div>

        <div class="card-body">
            <form method="POST" action="{{ route('admin.password.update') }}">
                @csrf

                <input type="hidden" name="token" value="{{ $token }}">

                <label for="email">Email</label><br/>
                <input id="email" type="email" class="@error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
                <br/>

                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong><br/>
                    </span>
                @enderror

                <label for="password">Password</label><br/>
                <input id="password" type="password" class="@error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                <br/>

                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong><br/>
                    </span>
                @enderror

                <label for="password-confirm">Confirm Password</label><br/>
                <input id="password-confirm" type="password" name="password_confirmation" required autocomplete="new-password"><br/><br/>

                <input id="reset-password-submit" type="submit" value="Reset Password" /><br/><br/>
            </form>
        </div>
    </div>
@endsection
