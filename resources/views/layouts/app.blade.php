<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'BianryTorch') }} @yield('title')</title>
    <meta name="description" content="@yield('description', 'We offer various high-quality software services as well as modern solutions which address real-life issues in many industries.')">
    <meta name="keywords" content="@yield('keywords', 'Binary Torch, Engineering, IT, software, machine vision, image processing, Robotics')">
    <!-- Styles -->
    <link href="{{ asset('css/pace.css') }}" rel="stylesheet">
    <script src="{{ asset('js/pace.js') }}"></script>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="shortcut icon" type="image/png" href="@image(fav.ico)" />
    <!-- Fonts and icons -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons"/>
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css"/>
    <link href="https://fonts.googleapis.com/css?family=Rubik" rel="stylesheet">
    @yield('custom_css')
    <style>
        [v-cloak] {
            display: none;
        }
    </style>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-109211505-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-109211505-1');
    </script>
</head>

<body class="landing-page">
    <div id="app" style="overflow-x: hidden; position: relative">
        @yield('content')
    </div>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>

    <script>
        let scene = document.getElementById('scene');
        if(scene){
            new Parallax(scene)
        }
        $('[data-toggle="tooltip"]').tooltip();
    </script>

    @if(config('app.server') == 'local')
        <script src="//{{ Request::getHost() }}:6001/socket.io/socket.io.js"></script>
    @endif

    @yield('custom_js')
</body>
</html>