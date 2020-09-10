<nav>
    <ul>
        <li @if($highlight == 'trending') class="highlight" @endif>
            <a @if($highlight == 'trending') href="#" @else href="{{ route('trending') }}" @endif>Trending</a>
        </li>

        <li @if($highlight == 'top') class="highlight" @endif>
            <a @if($highlight == 'top') href="#" @else href="{{ route('top') }}" @endif>Top</a>
        </li>

        @if(config('local.enabled'))
            <li @if($highlight == 'local') class="highlight" @endif>
                <a @if($highlight == 'local') href="#" class="highlight" @else href="{{ route('local') }}" @endif>Local</a>
            </li>
        @endif

        <li @if($highlight == 'vote') class="highlight" @endif>
            <a @if($highlight == 'vote') href="#" class="highlight" @else href="{{ route('voting') }}" @endif>Vote</a>
        </li>

        {{-- ?? Store Link ?? --}}
    </ul>
</nav>
<br/>