@extends('base.layout')

@section('title')
    Форум
@endsection

@section('content')
    <div class="page-header">
        <h1>Форум</h1>
    </div>
    <div class="forum_topics">
        @if(Auth::user() and !$parent_page->is_protected)
            <div class="add_topic">
               <a href="/forum/newtopic?id={{ $parent_page->id }}"><span class="glyphicon glyphicon-plus"></span>Создать тему</a>
            </div>
        @endif
        @if(isset($topics))
        @foreach($topics as $key => $topic)
                @if($topic->is_sheet)
                    <div class="row h4 well">
                        <a class="col-md-3" href="/forum?id={{$topic->id}}&page_number=1">{{$topic->title}}</a>
                        <div class="col-md-3">Создатель темы: <a href="/user?id={{ \App\User::where('user_name', '=', $page_messages[$key][0]->user)->first()->id }}">
                                {{ $page_messages[$key][0]->user }}
                        </a></div>
                        <div class="col-md-3">{{ $topic->created_at }}</div>
                        <div class="col-md-3">Всего ответов: {{ sizeof($page_messages[$key]) - 1 }}</div>
                    </div>
                @else
                    <div class="row h3 well">
                        <a class="col-md-7" href="/forum?id={{$topic->id}}&page_number=1">{{$topic->title}}</a>
                        <div class="col-md-5">Тем в разделе: {{ $topic->child_amount }}</div>
                    </div>
                @endif
        @endforeach
        @endif
    </div>
@endsection