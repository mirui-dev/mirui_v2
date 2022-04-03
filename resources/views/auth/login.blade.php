<html>

    <head>
        <title>mirui</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" type="text/css" href="{{asset('css')}}/base.css">
        <link rel="stylesheet" type="text/css" href="{{asset('css')}}/font.css">
        <link rel="stylesheet" type="text/css" href="{{asset('css')}}/mirui.css">
        <link rel="stylesheet" href="{{asset('css')}}/mirui-auth.css">

        <script src="{{asset('js')}}/base.js"></script>
        <script src="{{asset('js/views')}}/mirui-auth.js"></script>
        <script src="{{asset('js/views')}}/mirui-auth-login.js"></script>
        <script src="{{asset('js/components')}}/noti.js"></script>


        <script>
            var root = './../../';
        </script>

        <style>
            :root{
                --global-article-background: url::asset('image')/hero-fallback.jpg;
                --global-article-background-position: center;
            }
        </style>

    </head>

    <body>
        <div id="global-noti-parent" class="flex fill-width">
        </div>
        <header class="flex">
            <nav id="global-nav" class="flex">
                <a id="global-nav-menu-toggle" href="./../../">BACK [<]</a>
                <h1><a class="font-pri font-nohover" href="">mirui</a></h1>
                <div class="container">
                    <div class="row">
                        <form action="{{route('login-user')}}" method="post">
                        @if(Session::has('success'))
                            <div class="alert alert-success">{{Session::get('success')}}</div>
                        @endif
                        @if(Session::has('fail'))
                            <div class="alert alert-danger">{{Session::get('fail')}}</div>
                        @endif
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="flex flex-wrap">
                                <input type="email" class="form-control" placeholder="Email"  name="email" value="">
                                <span class="text-danger">@error('email'){{$message}} @enderror</span>
                            </div>
                            <div class="flex flex-wrap">
                                <input type="password" class="form-control" placeholder="Password" name="password">
                                <span class="text-danger">@error('password'){{$message}} @enderror</span>
                            </div>
                            <div class="flex flex-wrap">
                                <button type="submit">Login</button>
                                
                            </div>
                            <div class="flex flex-wrap">
                            <a href="{{url('register')}}">REGISTER</a>
                            </div>
                        </form>
                    </div>
                </div>
                <p id="global-nav-label">Illust. by 网易游戏</p>
            </nav>
        </header>

        <footer class="font-pri flex fill-width">
            <div>
                COPYRIGHT © 2020, MIRUI MEDIA CORPORATION. (ASIA)
            </div>
        </footer>
    </body>

</html>