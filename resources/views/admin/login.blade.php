@extends('layouts.admin')

@section('body')
    <div class="card">
        <br/><br/>
        @if(sizeof($errors) > 0)
            <div class="card-header">ಠ_ಠ</div><br/><br/>
        @else
            <div class="card-header">◕‿◕</div><br/><br/>
        @endif

        <div class="card-body">
            <form method="POST" action="{{ route('admin.login') }}">
                @csrf

                    <label for="email">Username</label><br/>
                    <input id="email" type="email" class="@if(sizeof($errors) > 0) is-invalid @endif" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                    <br/>

                    <label for="password">Secret Key</label><br/>
                    <input id="password" type="password" class="@if(sizeof($errors) > 0) is-invalid @endif" name="password" required autocomplete="current-password">
                    <br/><br/>

                    @if(sizeof($errors) > 0)
                        <span class="invalid-feedback" role="alert">
                            @if(is_array($errors))
                                @foreach($errors as $error => $message)
                                    <strong>{{ $message }}</strong>
                                @endforeach
                            @else
                                @foreach(json_decode($errors) as $error => $message)
                                    <strong>{{ $message[0] }}</strong>
                                @endforeach
                            @endif
                        </span>
                        <br/><br/>
                    @endif

                    <input type="submit" value="Onward" /><br/><br/><br/><br/>
            </form>
        </div>
    </div>
@endsection
