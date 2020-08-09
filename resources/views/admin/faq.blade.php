@extends('layouts.admin')

@section('body')
    <div class="faq-card">
        <br/><br/>
        <div class="card-header">{{ $show == 'view' ? 'Edit FAQ' : 'FAQs' }}</div><br/><br/>

        @if($show == 'index')
            {{-- Alerts --}}
            @if(session('failed-deletion'))
                <div class="invalid-feedback" role="alert">
                    <p>Failed to delete FAQ.</p>
                </div>
            @endif

            @if(session('created-faq'))
                <div class="alert-success" role="alert">
                    <p>New FAQ created!</p>
                </div>
            @endif

            @if(session('updated-faq'))
                <div class="alert-success" role="alert">
                    <p>FAQ updated!</p>
                </div>
            @endif

            {{-- Delete Forms --}}
            @foreach($faqs as $faq)
                <form id="delete-form-{{ $faq->id }}" action="{{ route('admin.faq.delete') }}" method="POST">
                    @csrf
                    <input type="hidden" name="faq-id" value="{{ $faq->id }}" />
                </form>
            @endforeach
                
            <form action="{{ route('admin.faq.create') }}" method="POST">
                @csrf
                <table class="faq-table">
                    {{-- Headers --}}
                    <tr>
                        <th>Question</th>
                        <th>Answer</th>
                        <th>Actions</th>
                    </tr>

                    {{-- Add row --}}
                    <tr>
                        <td><textarea name="question" placeholder="Question..." rows="2"></textarea></td>
                        <td><textarea name="answer" placeholder="Answer..." rows="2"></textarea></td>
                        <td><input type="image" name="submit" src="{{ route('assets.icon', ['identifier' => 'add']) }}" alt="Submit"></td>
                    </tr>

                    {{-- Current FAQ rows --}}
                    @foreach($faqs as $faq)
                        <tr>
                            <td>{{ $faq->question }}</td>
                            <td>{{ $faq->answer }}</td>
                            <td>
                                <a href="{{ route('admin.faq.view', ['id' => $faq->id]) }}">
                                    <img src="{{ route('assets.icon', ['identifier' => 'edit']) }}"/>
                                </a>
                                <a href="{{ route('admin.faq.view', ['id' => $faq->id]) }}"
                                    onclick="event.preventDefault();
                                        document.getElementById('delete-form-{{ $faq->id }}').submit();">
                                    <img src="{{ route('assets.icon', ['identifier' => 'delete']) }}"/>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </form>
        @elseif($show == 'view')
            <div class="card-body">
                <form class="faq-update-form" action="{{ route('admin.faq.update') }}" method="POST">
                    @csrf
                    <input type="hidden" name="faq-id" value="{{ $faq->id }}"/>
                    
                    {{-- Question --}}
                    <label for="question">Question...</label><br/>
                    <textarea id="question" name="question">{{ $faq->question }}</textarea>
                    <br/><br/>

                    {{-- Answer --}}
                    <label id="answer" for="answer">Answer...</label><br/>
                    <textarea name="answer">{{ $faq->answer }}</textarea>
                    <br/><br/>

                    {{-- Submit --}}
                    <input type="submit" value="Update" /><br/><br/>
                </form>
            </div>
        @endif
    </div>
@endsection
