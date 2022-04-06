<header class="flex {{ $isFullPageNav ? '' : 'max-height' }}">

    @if($isFullPageNav)
    <h1><a class="font-pri font-nohover" href="{{ route('mirui.landing') }}">mirui</a></h1>
    <a id="global-header-menu-toggle" onclick="global_nav_toggleNav();" href="javascript:;">MENU [+]</a>
    <nav id="global-nav" style="display:none">
        <a id="global-nav-menu-toggle" onclick="global_nav_toggleNav();" href="javascript:;">MENU [-]</a>
        <h1><a class="font-pri font-nohover" href="{{ route('mirui.landing') }}">mirui</a></h1>
        @auth
            Sign in to access mirui's huge movie collection now!
        @endauth
        <ul>
            @auth('web')
            <li>
                <a href="{{ route('mirui.dashboard') }}">DASHBOARD</a>
            </li>
            <li>
                <a href="{{-- route('mirui.auth.logout') --}}">SIGN OUT</a>
            </li>
            @endauth
            @guest
            <li>
                <a href="{{-- route('mirui.auth.login') --}}">SIGN IN</a>
            </li>
            @endguest
            <br>
            <li>
                <a href="{{ route('mirui.landing.aboutus') }}">ABOUT MIRUI</a>
            </li>
            <li>
                <a href="{{ route('mirui.landing.contactus') }}">CONTACT US</a>
            </li>
        </ul>
        <!-- <p id="global-nav-label">Illust. by Makoto Shinkai</p> -->
    </nav>
    @else
    <h1 class="flex">
        <a class="font-pri font-nohover" href="{{ route('mirui.landing') }}">
            mirui
        </a>
        <span>Redefining entertainment. </span>
    </h1>
    <a id="global-header-menu-toggle" onclick="global_nav_toggleNav();" href="javascript:;">MENU [+]</a>
    <nav id="global-nav" class="flex max-height fill-width" style="display:none">
        <a id="global-nav-menu-toggle" onclick="global_nav_toggleNav();" href="javascript:;">MENU [-]</a>
        <h1><a class="font-pri font-nohover" href="{{ route('mirui.landing') }}">mirui</a></h1>
        <ul>
            <!-- <li>
                <a href="./../dashboard/">DASHBOARD</a>
            </li>
            <li>
                <a href="./../auth/logout/">SIGN OUT</a>
            </li> -->
            @auth('web')
            <li>
                <a href="{{ route('mirui.dashboard') }}">DASHBOARD</a>
            </li>
            <li>
                <a href="{{-- route('mirui.auth.logout') --}}">SIGN OUT</a>
            </li>
            @endauth
            @guest
            <li>
                <a href="{{-- route('mirui.auth.login') --}}">SIGN IN</a>
            </li>
            @endguest
            <br>
            <li>
                <a href="{{ route('mirui.landing.aboutus') }}">ABOUT MIRUI</a>
            </li>
            <li>
                <a href="{{ route('mirui.landing.contactus') }}">CONTACT US</a>
            </li>
        </ul>
        <p id="global-nav-label">Illust. by 网易游戏</p>
    </nav>
    @endif
    
    <script>
        var isNav = 0;

        function global_nav_toggleNav(){
            if(isNav){
                setTimeout(function(){document.getElementById('global-nav').style.display = "none"}, 400);
                document.getElementById('global-nav').style.opacity = 0;
                isNav = 0;
            }else{
                document.getElementById('global-nav').style.display = "flex";
                document.getElementById('global-nav').style.opacity = 1;
                isNav = 1;
            }
        }
    </script>

</header>