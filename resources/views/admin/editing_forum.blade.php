@extends('admin.layout')
@section('content')
    <div class="content_editing h4">
        @foreach($messages as $message)
            <div class="message">
                {{ $message->content }}
                <form method="post" action="/admin/contents/forum/{{ $page_id }}/{{ $message->id }}/delete">
                    <input name="page_id" type="hidden" value="{{ $page_id }}">
                    <input name="message_id" type="hidden" value="{{ $message->id }}">
                    <input class="btn btn-danger" type="submit" value="Удалить" onclick="return confirm('Удалить это сообщение?')">
                </form>
            </div>
        @endforeach
    </div>
@endsection