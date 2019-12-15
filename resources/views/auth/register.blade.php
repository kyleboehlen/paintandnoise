@extends('layouts.semantic')

@section('body')
    <div class="card">
        <div class="card-header">Sign Up</div>

        <div class="card-body">
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <label for="name">Name</label><br/>
                <input id="name" type="text" class="@error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                <br/>

                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span><br/>
                @enderror

                <label for="email">Email</label><br/>
                <input id="email" type="email" class="@error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                <br/>

                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span><br/>
                @enderror

                <label for="password">Password</label><br/>
                <input id="password" type="password" class="@error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                <br/>

                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span><br/>
                @enderror

                <label for="password-confirm">Confirm Password</label><br/>
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                <br/><br/>

                <input type="submit" value="Sign Up" /><br/><br/>
            </form>
        </div>
    </div>
@endsection
