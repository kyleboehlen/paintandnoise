<div class="post">
    {{-- Category Header --}}
    <div class="category-header c-{{ $post->category['color'] }}">
        @if($category_link)
            <a href="{{ route('top.category', ['category_slug' => $post->category['slug']]) }}">
        @endif
        {{ $post->category['name'] }}
        @if($category_link)
            </a>
        @endif
    </div>

    {{-- Post content --}}
    <div class="content">
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
    <div class="artist-footer">
        Artist shit goes here
    </div>
</div>
<br/>