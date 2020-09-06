<div>
    {{-- Category Header --}}
    <div class="c-{{ $post->category['color'] }}">
        {{-- TO-DO: Add anchor tag for top page categories link --}}
        {{ $post->category['name'] }}
    </div>

    {{-- Post content --}}
    <div>
        @switch($post->types_id)
            @case($types::IMAGE)
                Image post
                @break

            @case($types::AUDIO)
                Audio Post
                @break

            @case($types::VIDEO)
                Video Post
                @break

            @case($types::TEXT)
                Text Post
                @break

            @case($types::EMBEDDED_SOUNDCLOUD)
                Soundcloud Post
                @break
        @endswitch
    </div>

    {{-- Artist footer --}}
    <div>
        Artist shit goes here
    </div>
</div>