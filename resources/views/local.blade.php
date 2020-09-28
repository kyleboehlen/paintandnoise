@extends('layouts.semantic')

@section('body')
    <x-main-nav :highlight="$nav_highlight" />

    @if(in_array('zip_alert', $show))
        <p class="set-zip">Please set update your zip code in your <a href="{{ route('account') }}">account</a> in order to browse the local feed.<p>
    @elseif(in_array('posts', $show))
        @foreach($posts as $key => $post)
            <x-post :id="$key" :post="$post" :link="$category_link" />
        @endforeach

        @if(method_exists($posts, 'links'))
            {{ $posts->links() }}
        @endif
    @endif
@endsection