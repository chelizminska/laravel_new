@extends('base.layout')
@section('content')
    <div class="forum_page">
        <ul class="pagination">
            @if($page_number > 1)
                <li><a href="/forum?id={{ $page_id }}&page_number={{$page_number - 1}}">{{ $page_number - 1 }}</a></li>
            @endif
            <li class="active"><a>{{$page_number}}</a></li>
            @if($page_number * 3 < $messages_count)
                <li><a href="/forum?id={{ $page_id }}&page_number={{$page_number + 1}}">{{ $page_number + 1 }}</a></li>
            @endif
        </ul>
        @foreach($messages as $message)
            <div class="message_block well">
                <div class="message_describer">
                    <h4>
                        Сообщение от: <a href="/user?id={{ \App\User::where('user_name', '=', $message->user)->first()->id }}">
                            {{ \App\User::where('user_name', '=', $message->user)->first()->user_name }}</a><br>
                        {{ $message->created_at }}
                        Сообщений на форуме: {{ \App\User::where('user_name', '=', $message->user)->first()->messages_amount }}<br>
                    </h4>
                </div>
                <div class="h3">
                    {{ $message->content }}
                </div>
            </div>
        @endforeach
        @if($page_number * 3 >= $messages_count)
            <div class="send_forum_message_form">
                @if(!Auth::guest())
                    <form method="post" action="/forum/add">
                        <textarea class="form-control" name="message_content" rows="8" cols="40" placeholder="Выше сообщение"></textarea>
                        <input type="hidden" name="page_id" value="{{ $page_id }}">
                        <input type="hidden" name="title" value="{{ $page_title }}">
                        <input type="hidden" name="user" value="{{ Auth::getUser()['user_name'] }}">
                        @if($page_number * 3 == $messages_count)
                            <input type="hidden" name="page_number" value="{{ $page_number + 1 }}">
                        @else
                            <input type="hidden" name="page_number" value="{{ $page_number }}">
                        @endif
                        <br>
                        <input class="btn btn-block btn-success" type="submit" value="Отправить">
                    </form>
                @else
                    <div class="alert alert-warning h4">
                        Вы должны <a href="/login">авторизироваться</a>, чтобы иметь возможность оставлять сообщения на форуме.
                    </div>
                @endif
            </div>
        @endif
    </div>
@endsection