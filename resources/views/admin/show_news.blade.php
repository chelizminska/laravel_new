@extends('admin.layout')
@section('content')
    <div class="h3">
        <a href="/admin/contents/news/add"><span class="glyphicon glyphicon-plus"></span>Добавить новость</a><br>
        <a href="/admin/contents/news/update"><span class="glyphicon glyphicon-refresh"></span>Обновить новости</a><br>
        @if($page_number > 1)
            <a href="/admin/contents/news?page_number={{$page_number - 1}}">{{ $page_number - 1 }}</a> ..
        @endif
        {{$page_number}}
        @if($page_number * 5 < $news_count)
            .. <a href="/admin/contents/news?page_number={{$page_number + 1}}">{{ $page_number + 1 }}</a>
        @endif
        @foreach($news as $n)
            <div class="news">
                {{ $n->title }}
                <a href="/admin/contents/news/edit?id={{ $n->id }}"><span class="glyphicon glyphicon-pencil"></span></a>
                <a href="/admin/contents/news/delete?id={{ $n->id }}" onclick="return confirm('Удалить эту новость?')"><span class="glyphicon glyphicon-trash"></span></a><br>
            </div>
        @endforeach
    </div>
@endsection