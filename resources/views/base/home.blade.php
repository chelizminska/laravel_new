@extends('base.layout')

@section('title')
    Главная
@endsection

@section('content')
    <div class="page-header">
        <h1>Главная</h1>
    </div>
    <div>
        <h3>Последние новости</h3>
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
    <div class="">
        <a class="btn btn-lg btn-primary" href="/news">Ко всем новостям&nbsp&raquo</a>
    </div>
@endsection