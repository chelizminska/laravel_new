@extends('admin.layout')
@section('content')
    <div class="adding h3">
        <a href="/admin/contents/fishes/add"><span class="glyphicon glyphicon-plus">Добавить</span></a>
    </div>
    <div class="content_editing h3">
        @foreach ($fishes as $fish)
            <a href="/admin/contents/fishes/edit?id={{ $fish->id }}">{{ $fish->title }}</a><br>
        @endforeach
    </div>
@endsection