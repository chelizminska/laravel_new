@extends('base.layout')

@section('title')
    Новости
@endsection

@section('content')
    <div class="page-header">
        <h1>Новости</h1>
    </div>
    @foreach ($news as $n)
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a href="/view_news?id={{ $n->id }}">{{ $n->title }}</a>&nbsp;
                    <span>{{ $n->created_at }}</span>
                </h4>
            </div>
            <div class="panel-body">
                <span>{{ strip_tags($n->description) }}</span>
                <a href="/view_news?id={{ $n->id }}"><span class="glyphicon glyphicon-chevron-right"></span>Читать далее</a>
            </div>
        </div>
    @endforeach
    <ul class="pager">
        @if($page_number > 1)
            <li><a href="/news?page_number={{ $page_number - 1 }}"><span class="glyphicon glyphicon-chevron-left"></span>Назад</a></li>
        @endif
        @if($page_number * 5 < $news_amount)
            <li><a href="/news?page_number={{ $page_number + 1 }}">Далее<span class="glyphicon glyphicon-chevron-right"></span></a></li>
        @endif
    </ul>
@endsection