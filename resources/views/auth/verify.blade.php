@extends('layouts.semantic')

@section('body')
    <div class="card">
        <br/>
        <div class="card-header">Verify Your Email</div>

        <div class="card-body">
            @if (session('resent'))
                <div class="alert-success" role="alert">
                    <p>A new verification link has been sent to your email address :)</p>
                </div>
            @endif

            <p>In an effort to fight spam and fake accounts you must verify your email to use your shiny new P&N account.</p>    
            <p>If you did not recieve an email you may</p>
            <form method="POST" action="{{ route('verification.resend') }}">
                @csrf
                <input id="request-verify-submit" type="submit" value="Request Another" />
            </form><br/><br/>
        </div>
    </div>
@endsection
