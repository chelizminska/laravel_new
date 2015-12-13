
<!--<style>
    body{
        color: #0a0137;
        width: 1300px;
        background-image: url("/images/background1op.jpg");
        background-repeat: no-repeat;
        background-attachment:fixed;
        background-size: 100%;
    }
    .menu{
        font-size: 30px;
        border-radius: 5px;
        margin-left: 100px;
        display: inline-block;
    }
    .user form{
        display: inline-block;
    }
    .menu ul{
        display: inline-block;
    }

    a{
        text-decoration: none;
        color: #843534;
    }
    .menu li{
        display: inline-block;
        margin-right: 20px;
    }
    .menu a{
        text-decoration: none;
        color: #3D7700;
    }
    .fishes{
        color: #BE5C00;
        font-size: 22px;
        font-style: italic;
    }
    .fishes h1{
        color: #BE5C00;
        font-size: 30px;
    }
    .center{
        margin: 180px 150px;
        background-color: #ffffff;
        min-height: 400px;
        border-radius: 15px;
        padding: 10px 40px;
    }
    .content a{
        text-decoration: underline;
        color: #269abc;
    }
    image{
        border-radius: 30px;
    }
    .error{
        color: red;
    }
    .user{
        margin-left: 50px;
        display: inline-block;
    }
    .login{
        font-size: 20px;
    }
    .login input{
        text-align: center;
        font-size: 15px;
        border-radius: 8px;
    }
    .register a{
        color: #204d74;
        text-decoration: underline;
    }
    .add_topic a{
        color: darkgreen;
    }
    .forum_topics{
        background-color: #269abc;
        border-radius: 15px;
        margin: 20px 20px;
        padding: 10px;
    }
    .topic{
        background-color: #ffffff;
        color: #0000C2;
        border-radius: 10px;
        margin: 10px;
    }
    .topic a{
        color: #0000C2;
        margin: 10px;
        font-size: 25px;
    }

    .forum_page{
    }

    .message_block{
        border: 2px solid #000000;
        margin-bottom: 1px;
    }



    .send_forum_message_form{
        margin: 30px 0px 0px 250px;
    }
    .send_forum_message_form textarea{
        border-radius: 8px;
        padding: 20px;
        font-size: 16px;
    }

    .send_forum_message_form input{
        border-radius: 5px;
        color: green;
        font-size: 20px;
        width: 130px;
        margin-left: 140px;
    }

    .message{
        border-left: 2px solid #000000;
        margin-left: -3px;
        display: inline-block;
        vertical-align: middle;

    }
    .message_describer{
        padding: 10px;
        border-right: 2px solid #000000;
        display: inline-block;
        margin-right: -3px;
        vertical-align: top;
    }
    .viewed_message{

    }
    .non_viewed_message{
        font-weight: bold;
    }
    .gen_link{
        margin: 20px;
    }
    .gen_link a{
        color: #000000;
        text-decoration: none;
        font-size: large;
    }
</style>-->

<html>
<head>
    <title>@yield('title')</title>
    <link rel="stylesheet" href="/bootstrap/css/bootstrap.css">
</head>
<body>
        <div class="navbar navbar-default navbar-fixed-top">
            <div class="container">
                <ul class="h3 nav navbar-nav">
                    <li><a href="/">Главная</a></li>
                    <li><a href="/forum">Форум</a></li>
                    <li><a href="/fishes">Рыбы беларуси</a></li>
                    <li><a href="/news">Новости</a></li>
                    <li><a href="/about">О клубе</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right h4">
                    @if(Auth::user())
                        <li><a href="/personal_info?user_id={{ Auth::user()->id }}"><span class="glyphicon glyphicon-user"></span>{{ Auth::user()['user_name'] }}</a></li>
                        <li> <a href="/logout">Выйти</a></li>
                        <li><a href="/personal_messages">Личные сообщения <span class="badge @if(\App\PersonalMessage::where('destination_user', '=', Auth::user()->user_name)
                         ->where('is_viewed', '=', false)->count() == 0) alert-info @else alert-warning @endif">{{
                        $new_messages_count = \App\PersonalMessage::where('destination_user', '=', Auth::user()->user_name)
                         ->where('is_viewed', '=', false)->count()
                        }}</span></a></li>
                    @else
                        <li><a>Гость&nbsp&nbsp&nbsp&nbsp</a></li>
                        <li><a href="/login">Войти</a></li>
                        <li><a href="/register">Еще не зарегистрированы?</a></li>
                    @endif
                </ul>
            </div>
        </div>
        @if(Session::has('breadcrumb_titles'))
        <div class="container" style="margin-top: 50px">
            <ol class="breadcrumb">
                @foreach( Session::get('breadcrumb_titles') as $key => $title )
                    <li><a href="{{ Session::get('breadcrumb_links')[$key] }}">{{ $title }}</a></li>
                @endforeach
            </ol>
        </div>
        @endif
        <div class="container" @if(! Session::has('breadcrumb_titles')) style="margin-top: 60px" @endif>
            <div class="content">
                @yield('content')
            </div>
        </div>

        <div class="footer">

        </div>

</body>
</html>