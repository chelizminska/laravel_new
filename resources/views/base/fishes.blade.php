@extends('base.layout')

@section('title')
    Рыбы беларуси
@endsection

@section('content')
    <div class="page-header">
        <h1>Рыбы беларуси</h1>
    </div>
    <div class="h3">
        @foreach($fishes as $fish)
            <a href="/fishes/{{ $fish->id }}">{{ $fish->title }}</a>
            <br>
        @endforeach
    </div>
@endsection