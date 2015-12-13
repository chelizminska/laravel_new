@extends('admin.layout')
@section('content')
    <form method="post" action="/admin/store">
        Название рыбы<br>
        <input type="text" name="name" placeholder="name"><br>
        Контент страницы<br>
        <textarea name="content" rows="10" cols="22"></textarea><br>
        <input type="submit" value="Создать страницу">
    </form>
@endsection