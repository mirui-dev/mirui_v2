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
        <link rel="stylesheet" href="{{ mix('src/mirui/css/mirui-landing.css') }}">

        @yield('styles')
        <!-- <link rel="stylesheet" href="{{ mix('src/mirui/css/mirui-aboutus.css') }}"> -->
        <!-- <link rel="stylesheet" href="{{ mix('src/mirui/css/mirui-auth.css') }}"> -->
        <!-- <link rel="stylesheet" href="{{ mix('src/mirui/css/mirui-contactus.css') }}"> -->

        @livewireStyles

    </head>

    <body class="@yield('body-class')">
        <div id="global-noti-parent" class="flex fill-width">
        </div>

        <!-- yeild is for normal contents, but slot is for components.  -->
        @yield('header')

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