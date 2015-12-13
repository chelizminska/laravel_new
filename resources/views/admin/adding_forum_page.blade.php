@extends('admin.layout')
@section('content')
    <div class="content_editing">
        <form method="post" action="/admin/contents/forum/add">
            <input type="text" name="title" placeholder="Название рыбы"><br>
            <textarea name="content" rows="20" cols="70" placeholder="Контент"></textarea><br>
            <input type="submit" value="Сохранить">
        </form>
    </div>
@endsection