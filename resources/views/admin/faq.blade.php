@extends('layouts.admin')

@section('body')
    <div class="faq-card">
        <br/><br/>
        <div class="card-header">FAQs</div><br/><br/>

        {{-- Delete Forms --}}
        @foreach($faqs as $faq)
            <form id="delete-form-{{ $faq->id }}" action="{{ route('admin.faq.delete') }}" method="POST">
                @csrf
                <input type="hidden" name="faq-id" value="{{ $faq->id }}" />
            </form>
        @endforeach
            
        <form action="{{ route('admin.faq.create') }}" method="POST">
            @csrf
            <table>
                {{-- Headers --}}
                <tr>
                    <th>Question</th>
                    <th>Answer</th>
                    <th>Actions</th>
                </tr>

                {{-- Add row --}}
                <tr>
                    <td><textarea name="question" placeholder="Question..." rows="2"></textarea></td>
                    <td><textarea name="answer" placeholder="Answer..." rows="2">></textarea></td>
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
    </div>
@endsection
