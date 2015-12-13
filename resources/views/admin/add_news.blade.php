@extends('admin.layout')
@section('content')
    <div class="content_editing col-md-6">
        <form method="post" action="/admin/contents/news/add">
            <input class="form-control" type="text" name="title" placeholder="Заголовок новости">
            <textarea class="form-control" name="description" rows="3" cols="70" placeholder="Описание"></textarea>
            <textarea class="form-control" name="content" rows="20" cols="70" placeholder="Контент"></textarea>
            <input class="btn btn-block btn-success" type="submit" value="Опубликовать новость">
        </form>
    </div>
@endsection