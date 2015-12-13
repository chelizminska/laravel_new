@extends('base.layout')

@section('title')
    Личные сообщения
@endsection

@section('content')
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title"><a href="/user?id={{ \App\User::where('user_name', '=', $message->source_user)->first()->id }}">{{ $message->source_user }}</a>
            написал вам {{ $message->created_at }}:</h3>
        </div>
        <div class="panel-body">
            <h3>{{ $message->content }}</h3>
            <h3><a class="btn btn-primary" href="/send_message_to_user?id={{ \App\User::where('user_name', '=', $message->source_user)->first()->id }}">Ответить</a></h3>
        </div>
    </div>
@endsection