<!--<style>
    .admin_layout{
        color: #888a85;
        font-size: 30px;
    }


    .categories a{
        color: #2ca02c;
        font-size: 24px;
        text-decoration: underline;
    }
    .error{
        color: red;
    }
    .user{
        text-align: right;
    }
    .login{
        font-size: 20px;
    }
    .adding{
        text-align: right;
        color: darkgreen;
    }
    .message{
        border: 1px solid #000000;
        width: 300px;
        display: inline-block;
    }
    form{
        display: inline-block;
    }
</style>
-->

<html>
<head>
    <title>Административная консоль</title>
    <link rel="stylesheet" href="/bootstrap/css/bootstrap.css">
</head>
    <body>
        <div class="container">
            <div class="row">
                <div class="h2 col-md-5 col-md-offset-1">
                    Административная консоль
                </div>
                @if( Auth::user() )
                    <div class="h3 col-md-offset-2 col-md-3">
                        <span>{{ Auth::user()['user_name'] }}</span>
                        <a href="/admin/logout">Выйти</a>
                    </div>
                @endif
            </div>
            @yield('content')
        </div>
    </body>
</html>