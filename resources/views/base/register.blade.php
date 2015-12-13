@extends('base.layout')

@section('title')
    Регистрация
@endsection

@section('content')
    <div class="col-md-6 col-md-offset-3">
        @foreach($errors->all() as $error)
            <div class="error">{{ $error }}</div>
        @endforeach
        <form action="/register" method="post">
            <h2 class="form-signin-heading">Регистрация</h2>
            <input class="form-control text-center" type="text" name="user_name" placeholder="username">
            <input class="form-control text-center" type="text" name="email" placeholder="email">
            <input class="form-control text-center" type="password" name="password" placeholder="password">
            <input class="form-control text-center" type="password" name="password_confirmation" placeholder="password-confirmation">
            <input class="btn btn-success btn-block" type="submit" value="Зарегистрироваться">
        </form>
    </div>
@endsection