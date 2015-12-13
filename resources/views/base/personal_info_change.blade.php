@extends('base.layout')
@section('content')
    <div>
        @foreach($errors->all() as $error)
            <div class="alert-warning">
                {{ $error }}
            </div>
        @endforeach
        <form action="/personal_info_username_save?user_id={{ $user->id }}" method="post">
            <input type="text" name="user_name" placeholder="username" value="{{ $user->name }}">
            <input type="submit" class="btn btn-success" value="Внести изменения">
        </form>
       <!-- <form action="/personal_info_password_save?user_id={{ $user->id }}" method="post">
            <input type="password" name="pre_password" placeholder="старый пароль">
            <input type="password" name="new_password" placeholder="новый пароль">
            <input type="password" name="new_password_confirmation" placeholder="подтвердите пароль">
            <input type="submit" class="btn btn-success" value="Внести изменения">
        </form>-->
    </div>
@endsection