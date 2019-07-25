<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ URL::asset('css/home.css') }}" />
    
    <style>
        .bk-nav-item{
            margin: 7px 0 0 7px;
        }

        .home-console {
            margin-top: -25px;
        }

        .list-nav {
            background-color: #ff000059;
            min-height: 95vh;
        }

        #col-left {
            border-right: 1px solid lightgray;
        }

        #col-right{
            border-left: 1px solid lightgray;
        }

        </style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'boojreadinglist.xyz') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('home') }}">
                                        Home
                                    </a>
                                    <a class="dropdown-item" href="{{ route('discover') }}">
                                        Discover
                                    </a>
                                    
                                    
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <div class="row no-gutters justify-content-center">

            <!-- Side navigation for users book lists -->
            <div class="col-6 col-sm-3 col-md-2 text-dark bg-light list-nav order-2 order-sm-1" style="min-height:95vh" id="col-left">
                <a href="/home">
                            <h5 class="bk-nav-item text-dark"> Make List +</h5><br>
                        </a>
                        <h5 class="bk-nav-item" style="text-decoration:underline">My booklists</h5>
                @foreach ( $booklists as $booklist)
                    <a href="/booklist/{{ $booklist->id }}">
                        <h5 class="bk-nav-item text-dark list-nav-item"> {{ $booklist->title }}</h5><br>
                    </a>
                @endforeach
            </div>

            <!-- Main UI for interacting with book lists/books/profiles/discover -->
            <div class="col-9 col-md-8 order-1 order-sm-2" style="">
                <main class="py-4">
                    @yield('content')
                </main>
            </div>

            <!-- Side bar for connecting with other users -->
            <div class="col-6 col-md-2 bg-light order-3" id="col-right">
                <h5 class="bk-nav-item">See what others are reading</h5>
                @foreach ( $users as $user)
                    <a href="/profile/{{ $user->id }}">
                        <h5 class="bk-nav-item">{{ $user->name }}</h5><br>
                    </a>
                @endforeach
            </div>

        </div>    
    </div>
</body>
</html>
