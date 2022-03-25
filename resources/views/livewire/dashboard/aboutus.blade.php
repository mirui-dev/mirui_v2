<html>

    <head>
        <title>About mirui - mirui</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="{{asset('css')}}/base.css">
        <link rel="stylesheet" type="text/css" href="{{asset('css')}}/font.css">
        <link rel="stylesheet" type="text/css" href="{{asset('css')}}/mirui.css">
        <link rel="stylesheet" type="text/css" href="{{asset('css')}}/mirui-aboutus.css">

        <script src="{{asset('js')}}/base.js"></script>
        <script src="{{asset('js')}}/nav.js"></script>
        <!-- <script src="./../src/js/components/noti.js"></script> -->
        <!-- <script src="./../src/js/components/asset.js"></script> -->
        <!-- <script src="./../src/js/components/article.js"></script> -->
        <!-- <script src="./../src/js/components/library.js"></script> -->
        <!-- <script src="./../src/js/components/user.js"></script> -->

        <script>
            var root = './../';
        </script>

        <style>
            :root{
                --global-article-background: url::asset('image')/hero-fallback.jpg;
                --global-article-background-position: center;
            }
        </style>

    </head>

    <body onload="" class="flex fill-width">
        <div id="global-noti-parent" class="flex fill-width">
        </div>
        
        <header class="flex max-height">
            <h1 class="flex">
                <a class="font-pri font-nohover" href="./../">
                    mirui
                </a>
                <span>Redefining entertainment. </span>
            </h1>
            <a id="global-header-menu-toggle" onclick="global_nav_toggleNav();" href="javascript:;">MENU [+]</a>
            <nav id="global-nav" class="flex max-height fill-width" style="display:none">
                <a id="global-nav-menu-toggle" onclick="global_nav_toggleNav();" href="javascript:;">MENU [-]</a>
                <h1><a class="font-pri font-nohover" href="./../">mirui</a></h1>
                <ul>
                    <!-- <li>
                        <a href="./../dashboard/">DASHBOARD</a>
                    </li>
                    <li>
                        <a href="./../auth/logout/">SIGN OUT</a>
                    </li> -->
                    <li>
                        <!-- <a href="auth/login"> -->
                            <?php 
                                if(isset($_SESSION['isAuth']) && $_SESSION['isAuth']){
                                    echo '<a href="./../dashboard/">';
                                    echo 'DASHBOARD';
                                    echo '</a></li><li>';
                                    echo '<a href="./../auth/logout/">';
                                    echo 'SIGN OUT';
                                }else{
                                    echo '<a href="./../auth/login/">';
                                    echo 'SIGN IN';
                                }
                                
                            ?>     
                        </a>
                    </li>
                    <br>
                    <li>
                        <a href="./../aboutus/">ABOUT MIRUI</a>
                    </li>
                    <li>
                        <a href="./../contactus/">CONTACT US</a>
                    </li>
                </ul>
                <p id="global-nav-label">Illust. by 网易游戏</p>
            </nav>
        </header>

        <main class="flex fill-width">
            <div class="flex fill-width fill-height">
                <h2 class="fill-width">About mirui</h2>
                <p>
                    <strong>MIRUI Media Corporation (Asia)</strong> is the sole distributor of japanese animation films (commonly known as 'anime') across the Asia Pacific region, since establishment in 2016. In 2020, <strong>mirui</strong> has started to provide premium online movie streaming services to users directly as part of their commitment in expanding their service coverage directly to the consumers. 
                    <br><br>
                    <strong>mirui</strong> has been in direct partnership with well-established anime production studios in Japan, primarily Kyoto Animation, CoMix Wave Films, Madhouse, White Fox and Square Enix. 
                    <br><br>
                    <strong>mirui</strong> was honoured to be the sole authorized distributor of produced japanese animation films in the Asia Pacific region, ie. Singapore, Malaysia, Indonesia, Thailand, China, and South Korea. 
                    This allows <strong>mirui</strong> to deliver original movie content from Japan directly to users in the Asia Pacific region, which has a majority of Japanese film audience. 
                    <br><br>
                    <strong>mirui</strong>-distributed films are available in all IMAX and THX certified theaters across the Asia Pacific region. 
                </p>
                <div style="padding:0; opacity: .9;">
                    <img src="{{asset('images/imax.png')}}" style="filter:invert(.7)">
                    <img src="{{asset('images/thx.png')}}" style="filter:invert(.7)">
                </div>
                <div class="flex disabled flex-wrap">
                    <img src="{{asset('images/white-fox.png')}}" style="filter:invert(.7)">
                    <img src="{{asset('images/square-enix.png')}}" style="filter:invert(.7)">
                    <img src="{{asset('images/madhouse.png')}}" style="filter:invert(.7)">
                    <img src="{{asset('images/kyoto-animation.png')}}">
                    <img src="{{asset('images/comix-wave-films.png')}}" style="filter:invert(1)">
                </div>
            </div>
        </main>

        <footer class="font-pri flex fill-width">
            <div>
                COPYRIGHT © 2020, MIRUI MEDIA CORPORATION. (ASIA)
            </div>
        </footer>
    </body>

</html>