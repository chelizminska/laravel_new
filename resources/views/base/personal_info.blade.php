@extends('base.layout')

@section('title')
    Личные данные
@endsection

@section('content')
    <div class="page-header">
        <h1>Личные данные</h1>
    </div>
    <div class="h3">
        {{ $user->user_name }}
    </div>
    <div class="h3">
        {{ $user->email }}
    </div>
    <div class="h3">
        Штрафные очки: <span @if($user->banning_points > 2) class="glyphicon glyphicon-exclamation-sign" style="color: orangered" @endif>{{ $user->banning_points }}</span>
    </div>
    <a href="/personal_info_change?user_id={{ $user->id }}"><h4><span class="glyphicon glyphicon-cog"></span>Изменить личные данные</h4></a>
@endsection