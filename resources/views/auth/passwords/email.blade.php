@extends('layouts.semantic')

@section('body')
    <div class="card">
        <br/>
        <div class="card-header">Forgot Password</div>

        <div class="card-body">
            @if(session('status'))
                <div class="alert-success" role="alert">
                    {{ session('status') }}
                </div><br/>
            @endif

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <label for="email">Email</label><br/>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                <br/>

                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    <br/>
                @enderror

                <br/>
                <input id="reset-link-submit" type="submit" value="Send Reset Link" /><br/><br/>
            </form>
        </div>
    </div>
@endsection
