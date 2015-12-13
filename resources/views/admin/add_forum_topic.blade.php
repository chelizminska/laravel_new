@extends('admin.layout')
@section('content')
    <div class="content_editing col-md-4 col-md-offset-1">
        <form method="post" action="/admin/contents/forum/{{ $parent_page->id }}/new_topic">
            <input class="form-control" type="text" name="title" placeholder="Название раздела">
            <input type="hidden" name="parent_page_id" value="{{ $parent_page->id }}">
            <input class="btn btn-block btn-success" type="submit" value="Создать раздел">
        </form>
    </div>
@endsection