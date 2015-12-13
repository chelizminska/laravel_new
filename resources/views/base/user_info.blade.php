@extends('base.layout')
@section('content')
    <div class="h2">
        {{ $dest_user->user_name }}
    </div>
    <div class="h3">
        Штрафные очки: <span @if($dest_user->banning_points > 2) class="glyphicon glyphicon-exclamation-sign" style="color: orangered" @endif>{{ $dest_user->banning_points }}</span>
    </div>
    @if(!Auth::user())
        <div class="h4 alert alert-warning">Чтобы отправить сообщение этому пользователю, вы должны <a href="/login">войти в систему.</a></div>
    @else
        <div class="h4">
            <a href="/send_message_to_user?id={{ $dest_user->id }}">Отправить сообщение пользователю.</a>
        </div>
    @endif
@endsection