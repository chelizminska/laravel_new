@extends('base.layout')
@section('content')
    @foreach( $errors->all() as $error)
        <div class="alert-warning">
            {{ $error }}
        </div>
    @endforeach
    <div class="col-md-6">
        <form action="/send_message_to_user" method="post">
            <h3>Кому:</h3> <input class="form-control" type="text" name="dest_user_name" @if(isset($dest_user))value="{{ $dest_user->user_name }} " @endif placeholder="Имя рользователя">
            <h3>Текст сообщения:</h3> <textarea class="form-control" name="content" cols="50" rows="5"></textarea><br>
            <input class="btn btn-success btn-block" type="submit" value="Отправить сообщение">
        </form>
    </div>
@endsection