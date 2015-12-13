@extends('base.layout')

@section('title')
    {{$fish['title']}}
@endsection

@section('content')
    <div class="fishes">
        <div class="page-header">
            <h1>{{ $fish['title']}}</h1>
        </div>
        <div>
            {!! $fish['content']!!}
        </div>
    </div>
@endsection