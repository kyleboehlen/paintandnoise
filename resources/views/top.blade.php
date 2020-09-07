@extends('layouts.semantic')

@section('body')
    <x-main-nav :highlight="$nav_highlight" />
    
    @foreach($posts as $post)
        <x-post :post="$post" :link="$category_link" />
    @endforeach

    @if(method_exists($posts, 'links'))
        {{ $posts->links() }}
    @endif
@endsection