@extends('layouts.semantic')

@section('body')
    <x-main-nav :highlight="$nav_highlight" />

    @if(in_array('zip_alert', $show))
        <div class="set-zip">
            {{-- Set zip message --}}
            {{-- link to account --}}
        </div>
    @elseif(in_array('posts', $show))
        @foreach($posts as $post)
            <x-post :post="$post" :link="$category_link"/>
        @endforeach

        @if(method_exists($posts, 'links'))
            {{ $posts->links() }}
        @endif
    @endif
@endsection