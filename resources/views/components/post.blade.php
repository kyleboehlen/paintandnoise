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
            <div class="audio-content">
                <audio class="listen" preload="none" data-size="200" src="{{ asset('audio/' . $post->asset['filename']) }}"></audio>
            </div>
            @break

        @case($types::VIDEO)
            Video Post
            @break

        @case($types::TEXT)
            <div class="txt-content">
                @foreach(explode(PHP_EOL, $post->asset['value']) as $line)
                    <p>{{ $line }}</p>
                @endforeach
            </div>
            @break
    @endswitch

    {{-- Artist footer --}}
    <div class="artist-footer">
        Artist shit goes here
    </div>
</div>
<br/>