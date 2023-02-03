<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=1280">
    <link rel="stylesheet" href="{{ asset("css/app.css") }}">
    <link rel="stylesheet" href="{{ asset("css/main.css") }}">
    <link rel="stylesheet" href="{{ asset("css/login.css") }}">
    <link rel="stylesheet" href="{{ asset("css/register.css") }}">
    <link rel="shortcut icon" href="{{ asset("image/icon.JPG") }}" type="image/jpg">
    <script type="text/javascript" src="{{ asset("js/scripts.js") }}" ></script>
    <title>social_network - login or register</title>
</head>
<body>
    <div class="wrapper">
        <div class="top">
            <div class="top__logo">
                <img src="{{asset("image/logo.JPG")}}" alt="">
                <a href="{{asset("")}}" class="main-page">social_network</a>
            </div>
            <div class="top__button">
                <button onclick="openInfo()">
                    ?
                </button>
            </div>
        </div>
        <div class="content">
            @yield('content')
        </div>
        <div class="info" id="info">
            <div class="info__block">
                <div class="info__top">
                    <div class="info__logo">
                        About
                    </div>
                    <div class="info__button">
                        <button onclick="closeInfo()">×</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
