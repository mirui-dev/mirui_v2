<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="{{ mix('src/mirui/css/font.css') }}">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('src/mirui/css/mirui.css') }}">
        <link rel="stylesheet" href="{{ mix('src/mirui/css/mirui-dashboard.css') }}">

        @livewireStyles

        <!-- Scripts -->
        <!-- <script src="{{ mix('src/mirui/js/mirui.js') }}" defer></script> -->

        <!-- <script src="./../src/js/base.js"></script>
        <script src="./../src/js/nav.js"></script>
        <script src="./../src/js/components/noti.js"></script>
        <script src="./../src/js/components/asset.js"></script>
        <script src="./../src/js/components/article.js"></script>
        <script src="./../src/js/components/cart.js"></script>
        <script src="./../src/js/components/library.js"></script>
        <script src="./../src/js/components/transaction.js"></script>
        <script src="./../src/js/components/user.js"></script>
        <script src="./../src/js/page-dashboard.js"></script>
        <script src="./../src/js/page-dashboard-article.js"></script>
        <script src="./../src/js/page-dashboard-cart.js"></script>
        <script src="./../src/js/page-dashboard-library.js"></script>
        <script src="./../src/js/page-dashboard-risk.js"></script>
        <script src="./../src/js/page-dashboard-transaction.js"></script>
        <script src="./../src/js/page-dashboard-user.js"></script> -->

        <script>
            var root = './../';
        </script>

    </head>

    <body>
        <div id="global-noti-parent" class="flex fill-width">
        </div>
        
        {{ $slot }}

        <footer class="font-pri flex fill-width">
            <div>
                COPYRIGHT © 2020-2022, MIRUI MEDIA CORPORATION. (ASIA)
            </div>
        </footer>

        @livewireScripts

        <script>

            // override session timeout behaviour
            // https://github.com/livewire/livewire/pull/1146
            window.livewire.onError(statusCode => {
                if(statusCode === 419){
                    window.location.reload();
                    return false;
                }
            })
            
        </script>

    </body>

</html>