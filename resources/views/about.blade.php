@extends('layouts.semantic')

@section('body')
    {{-- about section --}}
    <div class="about-section">
        <h2>What Is P&N?</h2>
        <div class="container">
            <img src="{{ route('assets.about') }}" />
            <p>
                Paint and Noise is a platform where you can discover artists, share your art, and affect the creative world.<br/><br/>
                By being a community of like minded people and inspired creaters we'd like to spark a collaboration and provide a foundation for artists to present their work to an audience as a whole.
            </p>
        </div>
    </div>

    {{-- how it works section --}}

    {{-- why section --}}

    {{-- team section --}}
    <div class="team-section">
        <h2>Our Team</h2>
        <div class="figure-container">
            @foreach(config('team.members') as $team_member)
                <figure>
                    <img src="{{ route('assets.team', $team_member['name']) }}"/>
                    <figcaption>{{ $team_member['full_name'] }}</figcaption>
                </figure>
            @endforeach
        </div>
    </div>
@endsection