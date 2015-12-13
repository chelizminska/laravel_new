@extends('admin.layout')
@section('content')
    <div class="content_editing h3">
        Имя пользователя: {{ $user->user_name }}<br>
        Электронная почта: {{ $user->email }}<br>
        Сообщений на форуме: {{ $user->messages_amount }}<br>
        @if(! $user->isAdmin)
            <div class="row">
                <form class="col-md-4" action="/admin/users/{{ $user->id }}/give_warning" method="post">
                    Степень нарушения:<br>
                    <select class="form-control text-center" name="points" size="1">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                    </select>
                    <input class="btn btn-danger btn-block" type="submit" value="Выдать предупреждение пользователю.">
                </form>
            </div>
            <div class="row">
                <form class="col-md-4" action="/admin/users/{{ $user->id }}/give_admin_rights" method="post">
                    <input class="btn btn-primary btn-block" type="submit" value="Дать права администратора" onclick="return(confirm('Вы действительно хотите наделить этого пользователя правами администратора?'))">
                </form>
            </div>
        @endif
    </div>
@endsection