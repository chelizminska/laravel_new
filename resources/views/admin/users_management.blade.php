@extends('admin.layout')
@section('content')
    <div class="panel panel-defaul">
        <div class="panel-heading">Пользователи сайта</div>
        <table class="table">
            <tr>
                <th>Пользователь</th>
                <th>Почта</th>
                <th>Сообщений на форуме</th>
                <th>Предупреждений</th>
            </tr>
        @foreach ($users as $user)
            <tr>
                <td><a href="/admin/users/{{ $user->id }}">{{ $user->user_name }}</a></td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->messages_amount }}</td>
                <td>{{ $user->banning_points }}</td>
            </tr>
        @endforeach
        </table>
    </div>
@endsection