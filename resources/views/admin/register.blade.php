@extends('admin.layout')
@section('content')
    @foreach($errors->all() as $error)
        <div class="error">{{ $error }}</div>
    @endforeach
    <form action="/admin/register" method="post">
        <input type="text" name="user_name" placeholder="username">
        <input type="text" name="email" placeholder="email">
        <input type="password" name="password" placeholder="password">
        <input type="password" name="password_confirmation" placeholder="password">
        <input type="submit" value="Зарегистрировать нового администратора">
    </form>
@endsection