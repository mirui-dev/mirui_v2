<html>

    <head>
        <title>Contact Us - mirui</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="{{asset('css')}}/base.css">
        <link rel="stylesheet" type="text/css" href="{{asset('css')}}/font.css"/>
        <link rel="stylesheet" type="text/css" href="{{asset('css')}}/mirui.css">
        <link rel="stylesheet" type="text/css" href="{{asset('css')}}/mirui-contactus.css">

        <script src="./js/base.js"></script>
        <script src="./js/nav.js"></script>


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
                    <li>

                            //<?php 
                                //if(isset($_SESSION['isAuth']) && $_SESSION['isAuth']){
                                   // echo '<a href="./../dashboard/">';
                                   // echo 'DASHBOARD';
                                   // echo '</a></li><li>';
                                   // echo '<a href="./../auth/logout/">';
                                   // echo 'SIGN OUT';
                               // }else{
                                   // echo '<a href="./../auth/login/">';
                                   // echo 'SIGN IN';
                             //   }
                                
                           // ?>     
                        </a>
                    </li>
                    <br>
                    <li>
                        <a href="./../aboutus/">ABOUT MIRUI</a>
                    </li>
                    <li>
                       / <a href="./../contactus/">CONTACT US</a>
                    </li>
                </ul>
                <p id="global-nav-label">Illust. by 网易游戏</p>
            </nav>
        </header>

        <main class="flex fill-width">
            <div class="flex fill-width fill-height">
                <h2 class="fill-width">Contact Us</h2>
                <p>
                    <strong>MIRUI Media Corporation (Asia)</strong>
                    <br>
                    597, Jalan Merak, 
                    <br>
                    Iping Garden, 
                    <br>
                    11960 Bayan Lepas, 
                    <br>
                    Pulau Pinang, Malaysia
                    <br><br>
                    hello@mirui.io
                </p>
                <iframe class="fill-width fill-height" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d31781.422084687667!2d100.24555697707262!3d5.312869802120468!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x304abfdc16a86cd3%3A0x62916eeda71a89b0!2sBayan%20Lepas%2C%20Penang!5e0!3m2!1sen!2smy!4v1600233978685!5m2!1sen!2smy" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
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