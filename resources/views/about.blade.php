@extends('layouts.semantic')

@section('body')
    {{-- about section --}}
    <div class="about-section">
        <h2>What Is P&N?</h2>
        <div class="container">
            <img src="{{ route('assets.about') }}" title="Photo by {{ config('media.about_attribution') }}"/>
            <p>
                Paint and Noise is a platform where you can discover artists, share your art, and affect the creative world.<br/><br/>
                By being a community of like minded people and inspired creators we'd like to spark a collaboration and provide a foundation for artists to present their work to an audience as a whole.
            </p>
        </div>
    </div>

    {{-- how it works section --}}
    <div class="how-section">
        <h2>How Does It Work?</h2>
        <div class="container">
            <p>
                When artists share their work the community, not some magic algorithm, decides what gets voted to the top.<br/><br/>
                Anybody can sign up to browse content, or vote on which posts they like.<br/><br/>
                Posts only last {{ config('posts.timeout') }} days so content stays fresh.
            </p>
            <img src="{{ route('assets.how') }}" title="Photo by {{ config('media.how_attribution') }}"/>
        </div>
    </div>

    {{-- why section --}}
    <div class="why-section">
        <h2>So, Like, Why?</h2>
        <div class="container">
            <img src="{{ route('assets.why') }}" title="Photo by {{ config('media.why_attribution') }}"/>
            <p>
                We're always on the hunt for fresh art, and 'underground' artists are often our favorite.<br/><br/>
                Current social media platforms cater to those that already have a large audience and isn't condusive for discovering artists at all.<br/><br/>
                We figured we couldn't be the only ones bugged by the status quo, and P&N was born!
            </p>
        </div>
    </div>

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