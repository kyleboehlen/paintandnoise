<nav>
    <ul>
        <li class="left @if($highlight == 'trending') highlight @endif">
            <a @if($highlight == 'trending') href="#" @else href="{{ route('trending') }}" @endif>Trending</a>
        </li>

        <li @if($highlight == 'top') class="highlight" @endif>
            <a @if($highlight == 'top') href="#" @else href="{{ route('top') }}" @endif>Top</a>
        </li>

        <li @if($highlight == 'local') class="highlight" @endif>
            <a @if($highlight == 'local') href="#" class="highlight" @else href="{{ route('local') }}" @endif>Local</a>
        </li>

        <li class="right @if($highlight == 'vote') highlight @endif">
            <a @if($highlight == 'vote') href="#" class="highlight" @else href="{{ route('voting') }}" @endif>Vote</a>
        </li>

        {{-- ?? Store Link ?? --}}
    </ul>
</nav>