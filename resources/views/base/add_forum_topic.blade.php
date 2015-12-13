@extends('base.layout')
@section('content')
    <div class="content_editing col-md-6">
        <form method="post" action="/forum/newtopic">
            <input class="form-control" type="text" name="title" placeholder="Название темы"><br>
            <input type="hidden" name="parent_page_id" value="{{ $parent_page->id }}">
            <textarea class="form-control" name="content" rows="20" cols="70" placeholder="Текст сообщения"></textarea><br>
            <input class="btn btn-success btn-block" type="submit" value="Создать тему">
        </form>
    </div>
@endsection