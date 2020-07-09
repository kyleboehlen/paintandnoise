@extends('layouts.semantic')

@section('body')
    <div class="faq-container">
        @foreach($faqs as $faq)
            <div class="faq-item">
                <h2>{{ $faq->question }}</h2>
                <p>{{ $faq->answer }}</p>
            </div>
        @endforeach
    </div>
@endsection