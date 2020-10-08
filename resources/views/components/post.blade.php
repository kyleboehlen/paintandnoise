<div class="post" id="post-{{ $id }}">
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
    @switch($post->types_id)
        @case($types::IMAGE)
            <div class="img-content">
                <img src="{{ asset('images/' . $post->asset['filename']) }}" />
            </div>
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
    @endswitch

    {{-- Artist footer --}}
    <div class="artist-footer">
        Artist shit goes here
    </div>
</div>
<br/>