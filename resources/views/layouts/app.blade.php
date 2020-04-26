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
                                <theme-switcher></theme-switcher>
                                    <a class="text-sm text-muted-light font-bold m-2" href="{{ route('login') }}">{{ __('Login') }}</a>

                                @if (Route::has('register'))
                                    <a class="text-sm text-muted-light font-bold m-2" href="{{ route('register') }}">{{ __('Register') }}</a>
                                @endif
                            @else
                                <theme-switcher></theme-switcher>
                                <dropdown align="right" width="100px">
                                    <template v-slot:trigger>
                                        <button href="#" class="flex items-center text-default no-underline text-sm"

                                        >
                                            <img src="{{ gravatar_url(Auth::user()->email) }}"
                                            class="rounded-full w-12 border-4 border-accent-light shadow">
                                            <span class="text-muted ml-2">{{ Auth::user()->name }}</span>
                                        </button>
                                    </template>

                                    <template v-slot:default>
                                        <form action="{{ route('logout') }}" method="POST" id="logout-form">
                                            @csrf

                                            <button type="submit" class="dropdown-menu-link text-left w-full">Logout</button>
                                        </form>
                                    </template>
                                </dropdown>
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
