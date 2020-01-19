@extends('layouts.admin')

@section('body')
    <div class="home-card">
        <br/><br/>
        <div class="card-header">Home</div><br/><br/>

        <div class="card-body">
            @foreach($tools as $tool)
                <a href="{{ route($tool->route_name) }}">
                    {{ $tool->name }}
                </a><br/>
            @endforeach
            <br/>
        </div>
    </div>
@endsection
