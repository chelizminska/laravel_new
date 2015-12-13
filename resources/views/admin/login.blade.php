@extends('admin.layout')
@section('content')
    @foreach($errors->all() as $error)
        <div class="error">{{ $error }}</div>
    @endforeach
    <div class="login col-md-offset-1 col-md-4">
        <form action="/admin/login" method="post">
            <input class="form-control text-center" type="text" name="user_name" placeholder="username">
            <input class="form-control text-center" type="password" name="password" placeholder="password">
            <input class="btn btn-success btn-block" type="submit" value="Войти">
        </form>
    </div>
@endsection