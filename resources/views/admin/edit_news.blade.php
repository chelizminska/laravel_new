@extends('admin.layout')
@section('content')
    <div class="content_editing">
        <div class="message col-md-6">
            <form method="post" action="/admin/contents/news/edit">
                <input type="hidden" name="id" value="{{ $news->id }}">
                <input class="form-control" type="text" name="title" value="{{ $news->title }}">
                <textarea class="form-control" name="content" rows="20" cols="70" placeholder="Контент">{{ $news->content }}</textarea>
                <input class="btn-block btn btn-success" type="submit" value="Сохранить">
            </form>
        </div>
    </div>
@endsection