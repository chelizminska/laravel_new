@extends('admin.layout')
@section('content')
    <div class="content_editing">
        <div class="row">
            <div class="col-md-6">
                <form method="post" action="/admin/contents/fishes/edit">
                    <input type="hidden" name="id" value="{{ $fish->id }}">
                    <input class="form-control" type="text" name="title" value="{{ $fish->title }}" placeholder="Рыба">
                    <textarea class="form-control" name="content" rows="20" cols="70">{{ $fish->content }}</textarea>
                    <input class="btn btn-success btn-block" type="submit" value="Сохранить">
                </form>
            </div>
        </div>
        <div class="row">
            <div class="adding col-md-6">
                <form action="/admin/contents/fishes/delete" method="get">
                    <input class="form-control" type="hidden" name="id" value="{{ $fish->id }}">
                    <input class="btn btn-block btn-danger" type="submit" value="Удалить" onclick="return confirm('Вы точно хотите удалить {{ $fish->title }}')">
                </form>
            </div>
        </div>
    </div>
@endsection