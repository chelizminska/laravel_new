@extends('admin.layout')
@section('content')
    <div class="content_editing col-md-4">
        <form method="post" action="/admin/contents/home">
            <textarea class="form-control" name="content" rows="20" cols="70">{{ $page['content'] }}</textarea><br>
            <input class="btn btn-block btn-success" type="submit" value="Сохранить">
        </form>
    </div>
@endsection