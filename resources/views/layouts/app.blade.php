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
<body class="theme-light bg-page">
    <div id="app">
        <nav class="bg-header shadow">
            <div class="container mx-auto">
                <div class="flex justify-between items-center py-3">
                    <h1>
                        <a class="flex justify-between items-center" href="{{ url('/') }}">
                            <img src="/images/birdcheck.png" alt="">
                            <span class="text-default font-bold text-xl px-2">birdboard </span>
                            <span class="text-muted text-sm px-1">| feathery reminders</span>
                        </a>
                    </h1>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <!-- Left Side Of Navbar -->
                        <ul class="">

                        </ul>

                        <!-- Right Side Of Navbar -->
                        <div class="flex items-center ml-auto">
                            <!-- Authentication Links -->
                            @guest
                                    <a class="text-sm text-muted-light font-bold m-2" href="{{ route('login') }}">{{ __('Login') }}</a>

                                @if (Route::has('register'))
                                    <a class="text-sm text-muted-light font-bold m-2" href="{{ route('register') }}">{{ __('Register') }}</a>
                                @endif
                            @else
                                <theme-switcher></theme-switcher>
                                <a href="#" class="flex items-center text-default no-underline text-sm"
                                        role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-prev
                                    >
                                        <img src="{{ gravatar_url(Auth::user()->email) }}"
                                        alt="{{ Auth::user()->name }}'s avatar"
                                        class="rounded-full w-12 border-4 border-accent-light shadow">
                                        <span class="text-muted ml-2">{{ Auth::user()->name }}</span>
                                </a>

                                <div class="self-center">
                                    <a href="{{ route('logout') }}" class="text-sm text-muted-light font-bold"
                                           onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                    </form>
                                </div>
                            @endguest
                            </div>
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
