@extends('layouts.semantic')

@section('body')
    {{-- about section --}}

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