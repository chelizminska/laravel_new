@extends('base.layout')

@section('title')
    Личные сообщения
@endsection

@section('content')
    <div class="page-header">
        <h1>Личные сообщения</h1>
    </div>
    <table class="table table-striped">
        @foreach ($messages as $message)
            <tr class="message h4">
                <td>
                    <a @if ($message->is_viewed) class="text-info" @else class="text-danger" @endif href="/personal_message?id={{ $message->id }}">
                        {{ substr($message->content, 0, 20) }}
                        @if (strlen($message->content) > 20) ... @endif
                    </a>
                </td>
                <td>
                    От <a href="/user?id={{ \App\User::where('user_name', '=', $message->source_user)->first()->id }}">{{ $message->source_user }}</a>
                </td>
                <td>
                    {{ $message->created_at }}
                </td>
            </tr>
        @endforeach
    </table>
@endsection