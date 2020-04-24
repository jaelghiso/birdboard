<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Birdboard') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.8.2/css/bulma.css" integrity="sha256-8BrtNNtStED9syS9F+xXeP815KGv6ELiCfJFQmGi1Bg=" crossorigin="anonymous" />
</head>
<body class="bg-gray-200">
    <div id="app">
        <nav class="bg-white shadow">
            <div class="container mx-auto">
                <div class="flex justify-between items-center py-3">
                    <h1>
                        <a class="flex justify-between items-center" href="{{ url('/') }}">
                            <img src="/images/birdcheck.png" alt="">
                            <span class="text-black font-bold text-xl px-2">birdboard </span>
                            <span class="text-gray-700 text-sm px-1">| feathery reminders</span>
                        </a>
                    </h1>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <!-- Left Side Of Navbar -->
                        <ul class="">

                        </ul>

                        <!-- Right Side Of Navbar -->
                        <ul class="">
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
                                <li class="flex flex-col">
                                    <a href="#" class="self-center">
                                        <img src="{{ gravatar_url(Auth::user()->email) }}"
                                        alt="{{ Auth::user()->name }}'s avatar"
                                        class="rounded-full w-12 border-4 border-teal-400 shadow">

                                    </a>

                                    <div class="self-center">
                                        <a href="{{ route('logout') }}" class="text-sm text-gray-600 font-bold"
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

            </div>
        </nav>

        <main class="container mx-auto py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
