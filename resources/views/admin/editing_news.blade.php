@extends('admin.layout')
@section('content')
    <div class="content_editing col-md-6">
        <form method="post" action="/admin/contents/news">
            <textarea class="form-control" name="content" rows="20" cols="70">{{ $page['content'] }}</textarea><br>
            <input class="btn btn-success btn-block" type="submit" value="Сохранить">
        </form>
    </div>
@endsection