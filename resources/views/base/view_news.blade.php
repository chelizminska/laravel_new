@extends('base.layout')

@section('title')
    {{ $news->title }}
@endsection

@section('content')
    <div class="page-header">
        <h1>{{ $news->title }}</h1>
    </div>
    <div class="well">
        {!! $news->content !!}
    </div>
@endsection