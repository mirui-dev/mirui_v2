<?php
use Config\Session;

?>

<html>

    <head>
        <title>mirui</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" type="text/css" href="{{asset('css')}}/base.css">
        <link rel="stylesheet" type="text/css" href="{{asset('css')}}/font.css">
        <link rel="stylesheet" type="text/css" href="{{asset('css')}}/mirui.css">
        <link rel="stylesheet" href="{{asset('css/components')}}/article.css">

        <script src="{{asset('js')}}/base.js"></script>
        <script src="{{asset('js')}}/nav.js"></script>
        <script src="{{asset('js')}}/article.js"></script>
        <script src="{{asset('js/components')}}/article.js"></script>
        <script src="{{asset('js/components')}}/asset.js"></script>
        <script src="{{asset('js/components')}}/noti.js"></script>

        <script>
            var root = './';
        </script>
        
    </head>

    <body onload="rootArticleControl(true)">
        <div id="global-noti-parent" class="flex fill-width">
        </div>

        <header class="flex">
            <h1><a class="font-pri font-nohover" href="">mirui</a></h1>
            <a id="global-header-menu-toggle" onclick="global_nav_toggleNav();" href="javascript:;">MENU [+]</a>
            <nav id="global-nav" style="display:none">
                <a id="global-nav-menu-toggle" onclick="global_nav_toggleNav();" href="javascript:;">MENU [-]</a>
                <h1><a class="font-pri font-nohover" href="">mirui</a></h1>
                <?php
                    if(!isset($_SESSION['isAuth']) || !$_SESSION['isAuth']){
                        echo "Sign in to access mirui's huge movie collection now!";
                    }
                ?>
                <ul>
                    <!-- <li><a href="#">NEW ARRIVALS</a></li>
                    <li><a href="#">TRENDING HOT</a></li>
                    <li><a href="#">UPCOMING</a></li>
                    <li><a href="#">GENRE</a></li> -->
                    <!-- <li><a href="#">ABOUT</a></li> -->
                    <!-- <br> -->
                    <li>
                        <!-- <a href="auth/login"> -->
                            <?php 
                                if(isset($_SESSION['isAuth']) && $_SESSION['isAuth']){
                                  echo '<a href="./dashboard/">';
                                  echo 'DASHBOARD';
                                  echo '</a></li><li>';
                                  echo '<a href="./auth/logout/">';
                                  echo 'SIGN OUT';
                                }else{
                                  echo '<a href="./auth/login/">';
                                  echo 'SIGN IN';
                                }
                                
                            ?>     
                        </a>
                    </li>
                    <br>
                    <li>
                        <a href="./aboutus/">ABOUT MIRUI</a>
                    </li>
                    <li>
                        <a href="./contactus/">CONTACT US</a>
                    </li>
                </ul>
                <!-- <p id="global-nav-label">Illust. by Makoto Shinkai</p> -->
            </nav>
        </header>
        
        <section class="flex max-width max-height">
            <a onclick="rootArticleControl(false)" id="global-section-nav-back" class="flex global-section-nav max-height font-nohover" href="javascript:;"><</a>
            <a onclick="rootArticleControl(false)" id="global-section-nav-next" class="flex global-section-nav max-height font-nohover" href="javascript:;">></a>
            <article id="global-article-parent" class="flex max-width max-height">
                <div id="global-article-container" class="flex">
                    <h2 id="global-article-title" class="font-pri max-width">--</h2>
                    <h2 id="global-article-subtitle" class="font-pri fill-width">--</h2>
                    <p id="global-article-body">
                        --
                    </p>
                    <a class="font-pri global-button" href="./dashboard/"><button>LEARN MORE</button></a>
                    <a class="font-pri global-button" href="./watch?v=null"><button>WATCH NOW</button></a>
                </div>
            </article>
        </section>

        <footer class="font-pri flex fill-width">
            <div>
                COPYRIGHT © 2020, MIRUI MEDIA CORPORATION. (ASIA)
            </div>
        </footer>
    </body>

</html>
