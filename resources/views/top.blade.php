@extends('layouts.semantic')

@section('body')
    <x-main-nav :highlight="$nav_highlight" />
    
    @foreach($posts as $key => $post)
        <x-post :id="$key" :post="$post" :link="$category_link" />
    @endforeach

    @if(method_exists($posts, 'links'))
        {{ $posts->links() }}
    @endif
@endsection