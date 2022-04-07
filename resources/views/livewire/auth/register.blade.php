<header class="flex">

    @section('styles')
    <link rel="stylesheet" href="{{ mix('src/mirui/css/mirui-auth.css') }}">
    <style>
        :root{
            --global-article-background: url({{ mix('src/mirui/img/core/hero-register.jpg') }});
            --global-article-background-position: center;
        }
    </style>
    @endsection

    <nav id="global-nav" class="flex">
    <a id="global-nav-menu-toggle" href="{{ route('mirui.landing') }}">BACK [<]</a>
        <h1><a class="font-pri font-nohover" href="">mirui</a></h1>
        <div id="auth-new-parent" class="flex flex-wrap auth--parent" wire:loading.class="disabled" wire:target="authHandler">
            <div id="auth-new-form" class="flex flex-wrap" wire:keydown.enter="authHandler()">
                <div class="flex flex-wrap">
                    <input id="auth-new-form-name" wire:model="name" type="text" placeholder="Display Name" autocomplete="off" autofocus required minlength="1"></input>
                    <input id="auth-new-form-username" wire:model="username" type="text" placeholder="Username" autocomplete="username" required minlength="6"></input>
                </div>
                <div class="flex flex-wrap">
                    <input id="auth-new-form-password" wire:model="password" type="password" placeholder="Password" autocomplete="new-password" required minlength="8"></input>
                    <input id="auth-new-form-password-confirm" wire:model="password_confirmation" type="password" placeholder="Confirm Password" autocomplete="new-password" required minlength="8"></input>
                </div>
                <div class="flex fill-width">
                    <input id="auth-new-form-email" wire:model="email" type="email" placeholder="Email" autocomplete="email" required minlength="5"></input>
                </div>
            </div>
            <div id="auth-new-low" class="flex auth--low">
                <a class="font-pri global-button" wire:click="authHandler()" href="javascript:;"><button>REGISTER</button></a>
                <a class="font-pri global-button" href="{{ route('mirui.auth.login') }}"><button>BACK</button></a>
            </div>
        </div>
        <p id="global-nav-label">Illust. by 网易游戏</p>
    </nav>

</header>