<header class="flex">

    @section('styles')
    <link rel="stylesheet" href="{{ mix('src/mirui/css/mirui-auth.css') }}">
    <style>
        :root{
            --global-article-background: url({{ mix('src/mirui/img/core/hero-login.jpg') }});
            --global-article-background-position: center;
        }
    </style>
    @endsection

    <nav id="global-nav" class="flex">
        <a id="global-nav-menu-toggle" href="{{ route('mirui.landing') }}">BACK [<]</a>
        <h1><a class="font-pri font-nohover" href="">mirui</a></h1>
        <div id="auth-login-parent" class="flex flex-wrap auth--parent" wire:loading.class="disabled" wire:target="authHandler">
            <div id="auth-login-form" class="flex flex-wrap" wire:keydown.enter="authHandler()">
                <!-- https://laravel-livewire.com/docs/2.x/actions#keydown-modifiers -->
                <input id="auth-login-form-username" wire:model="username" type="text" placeholder="Username or email" autocomplete="username" autofocus required minlength="4"></input>
                <input id="auth-login-form-password" wire:model="password" type="password" placeholder="Password" autocomplete="current-password" required minlength="8"></input>
            </div>
            <div id="auth-login-low" class="flex auth--low">
                <a class="font-pri global-button" wire:click="authHandler()" href="javascript:;"><button>LOGIN</button></a>
                <a class="font-pri global-button" href="{{ route('mirui.auth.register') }}"><button>REGISTER</button></a>
            </div>
        </div>
        <p id="global-nav-label">Illust. by 网易游戏</p>
    </nav>

</header>