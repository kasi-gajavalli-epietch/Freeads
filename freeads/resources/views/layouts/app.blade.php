<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=yes">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
        

        
       <!-- CSS only -->
        <link rel="stylesheet" type="text/css" href="{{ url('/css/app.css') }}" />
        <link rel="stylesheet" type="text/css" href="{{ url('/css/style.css') }}" />
        <style>
            <link rel="stylesheet" type="text/css" href="{{ url('/css/app.css') }}" />
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>
        <title>Freeads</title>

        <!-- Fonts 
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">-->

        <!-- Scripts 
        @vite(['resources/css/app.css', 'resources/js/app.js'])-->
    </head>
    <body>
    <body>
    <div id="app" style=" padding:6vh 10vw;">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm" style="display:flex; justify-content:space-between; padding-bottom: 10px; border-bottom: 2px solid gray;"> 
            <div class="right">
                <div class="navbar-nav" style="display:grid; grid-template-columns: auto auto auto auto; ">
                    <div class="nav-item {{ Route::currentRouteName() == 'advertisement.index' ? 'active' : '' }}">
                        <img src="{{ url('/images/logo.png') }}" class="img-fluid " alt="logo">
                    </div>
                    <div class="nav-item {{ Route::currentRouteName() == 'advertisement.index' ? 'active' : '' }}" style="margin:15px;">
                        <a class="nav-link" href="{{ route('advertisement.index') }}">Home</a>
                    </div>
                    @auth
                        <!--<a class="nav-link" href="{{ route('advertisement.index') }}">Classifieds board</a>-->
                        <div class="nav-item {{ Route::currentRouteName() == 'advertisement.admin' ? 'active' : '' }}" style="margin:15px;">
                            <a class="nav-link" href="{{ route('advertisement.admin') }}">My ads</a>
                        </div>
                    @endauth
                    <div class="nav-item {{ Route::currentRouteName() == 'advertisement.create' ? 'active' : '' }}" style="margin:15px;">
                        <a class="nav-link" href="{{ route('advertisement.create') }}">Post ad</a>
                    </div>
                </div>
                <!--<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>-->
            </div>
            <div class="left" style="display:grid; grid-template-columns: auto auto auto;">
                <div class="left_nav-links" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">

                    </ul>
                </div>
                @guest
                        @if (Route::has('login'))
                            <div class="nav-item" style="text-decoration:none;">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </div>
                        @endif

                        @if (Route::has('register'))
                            <div class="nav-item" style="text-decoration:none;">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </div>
                        @endif
                    @else
                        
                    <div class="nav-link" style="text-transform: capitalize;">
                        <a class="user-name" style="text-decoration:none;" href="#" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
                        </a>
                    </div>
                    
                    <div class="nav-link" >
                        <a class="logout-btn" style="text-decoration:none;" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                            class="d-none">
                            @csrf
                        </form>
                    </div>
                @endguest
            </div>
        </nav><br>
        <div class="nav-bar2" style="padding-left:20px; padding-bottom: 10px; border-bottom: 2px solid gray; border-radius: 10px;">
            <div class="searchbar" style="display:flex;">
                <form class="d-flex" action="{{ route('search') }}" method="post">
                    @csrf
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="search">
                    <button class="btn btn-outline-primary" type="submit">Search</button>
                </form>
                <div class="condition" style="display: flex; padding-left: 60px; margin-top: 10px; text-align: center;">
                    <p>Condition</p>
                    <div style="width: 20px;"></div>
                    <!-- Checked checkbox -->
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" checked/>
                        <label class="form-check-label" for="flexCheckChecked"><p>NEW</p></label>
                    </div>
                    <!-- UnChecked checkbox -->
                    <div style="width: 20px;"></div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
                        <label class="form-check-label" for="flexCheckDefault"><p>GOOD</p></label>
                    </div>
                    <div style="width: 20px;"></div>

                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
                        <label class="form-check-label" for="flexCheckDefault"><p>USED</p></label>
                    </div>
                </div>
                <div class="price-range" style="display:flex; padding-left: 60px;">
                    <p><b>PriceRange</b></p>
                    <div class="col-6">
                        <div class="input-group" style="width: 150px; padding-left: 30px;">
                        <input type="text" placeholder="Min" class="form-control">
                        </div>
                    </div><br>
                    <div class="col-6">
                        <div class="input-group" style="width: 150px; padding-left: 30px;">
                        <input type="text" placeholder="Max" class="form-control">
                        </div>
                    </div>
                    <div class="col-6">
                    <button type="submit" class="btn btn-primary">Submit</button></button>
                    </div>
                </div>
            </div>
        </div>
        <main class="py-4">
            @if (Session::has('message') && Session::has('message_type'))
                <p class="alert alert-{{ Session::get('message_type') }}">{{ Session::get('message') }}</p>
            @endif
            @yield('content')
        </main>

    </div>
    </body>
</html>
