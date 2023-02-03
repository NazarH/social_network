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
    <link rel="stylesheet" href="{{ asset("css/auth.css") }}">
    <link rel="stylesheet" href="{{ asset("css/friends.css") }}">
    <link rel="stylesheet" href=" {{asset("css/groups.css")}}">
    <link rel="stylesheet" href="{{asset("css/news.css")}}">
    <link rel="stylesheet" href="{{asset("css/messages.css")}}">
    <link rel="stylesheet" href="{{asset("css/search.css")}}">
    <link rel="shortcut icon" href="{{ asset("image/icon.JPG") }}" type="image/jpg">
    <script type="text/javascript" src="{{ asset("js/scripts.js") }}" ></script>
    <title>social_network - {{Auth::user()->name}}</title>
</head>
<body>
<div class="wrapper">
    <div class="top">
        <div class="top__logo">
            <img src="{{asset("image/logo.JPG")}}" alt="">
            <a href="{{asset("news")}}" class="main-page">social_network</a>
        </div>
        <div class="top__button-auth">
            <button onclick="fullScreen()">
                ⤢
            </button>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
                <button>
                    × <a href="{{ route('logout') }}"
                         onclick="event.preventDefault();
                              document.getElementById('logout-form').submit();">
                    </a>
                </button>
            </form>
        </div>
    </div>
    <div class="content-auth">
        <div class="profile-menu">
            <ul>
                <li><a href="{{route('profile',['user'=>Auth::user()->id])}}">My page</a></li>
                <li><a href="{{route('messages')}}">Messages</a></li>
                <li><a href="{{route('friends')}}">Friends</a></li>
                <li><a href="{{route('groups.main_page')}}">Groups</a></li>
                <li><a href="{{asset('news')}}" id="menuItem5">News</a></li>
                <li>
                    Search
                    <div class="dropdown">
                        <a href="{{ route('search.users') }}">Search Users</a>
                        <a href="{{ route('search.groups') }}">Search Groups</a>
                    </div>
                </li>
            </ul>
        </div>
        <div class="profile">
            @yield('content')
        </div>
    </div>
</div>
</body>
</html>
