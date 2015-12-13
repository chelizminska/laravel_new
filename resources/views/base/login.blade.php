@extends('base.layout')

@section('title')
    Авторизация
@endsection

@section('content')
    <div class="container col-md-3 col-md-offset-4">
        @foreach($errors->all() as $error)
            <div class="alert-warning">{{ $error }}</div>
        @endforeach
        <form class="form-signin" action="/login" method="post">
            <h2 class="form-signin-heading">Авторизация</h2>
            <input class="form-control" type="text" name="user_name" placeholder="username">
            <input class="form-control" type="password" name="password" placeholder="password">
            <input type="hidden" name="url" value="{{ $url }}">
            <input class="btn btn-success btn-block" type="submit" value="Войти">
        </form>
    </div>
@endsection