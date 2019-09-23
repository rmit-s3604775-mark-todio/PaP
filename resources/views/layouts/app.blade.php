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
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>
                    <div class="header-center justify-content-end">
                        @guest

                        @else
                        <img id="header-avatar" class="avatar" src="/uploads/avatars/{{ Auth::user()->avatar }}">
                        @endguest
                    </div>
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
                                    @if(Auth::guard('admin')->check() & !Auth::guard('web')->check())
                                        <a class="dropdown-item" href="{{ route('admin.dashboard') }}">
                                            {{ __('Home') }}
                                        </a>
                                        <a class="dropdown-item" href="{{ route('admin.settings') }}">
                                            {{ __('Settings') }}
                                        </a>
                                        <a class="dropdown-item" href="{{ route('admin.users') }}">
                                            {{ __('Users') }}
                                        </a>
                                        <a class="dropdown-item" href="{{ route('admin.administrators') }}">
                                            {{ __('Administrators') }}
                                        </a>
                                        <a class="dropdown-item" href="{{ route('admin.products') }}">
                                            {{ __('Products') }}
                                        </a>
                                        <a class="dropdown-item" href="{{ route('admin.messages') }}">
                                            {{ __('Messages') }}
                                        </a>
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                        document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>
                                    @endif

                                    @if(Auth::guard('web')->check() & !Auth::guard('admin')->check())
                                        <a class="dropdown-item" href="{{ route('home') }}">
                                            {{ __('Home') }}
                                        </a>
										                    <a class="dropdown-item" href="{{ route('products.index') }}">
                                            {{ __('Products') }}
                                        </a>
                                        <a class="dropdown-item" href="{{ route('product-request.index') }}">
                                            {{ __('Product Requests') }}
                                        </a>
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                        document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>
                                    @endif

                                    @if(Auth::guard('admin')->check() & Auth::guard('web')->check())
                                        <p class="dropdown-header">
                                            {{ __('User') }}
                                        </p>
                                        <a class="dropdown-item" href="{{ route('home') }}">
                                            {{ __('Home') }}
                                        </a>
										                    <a class="dropdown-item" href="{{ route('products.index') }}">
                                            {{ __('Products') }}
                                        </a>
                                        <a class="dropdown-item" href="{{ route('product-request.index') }}">
                                            {{ __('Product Requests') }}
                                        </a>
                                        <a class="dropdown-item" href="{{ route('user.logout') }}">
                                            {{ __('Logout') }}
                                        </a>
                                        <p class="dropdown-header">
                                            {{ __('Administrator') }}
                                        </p>
                                        <a class="dropdown-item" href="{{ route('admin.dashboard') }}">
                                            {{ __('Home') }}
                                        </a>
                                        <a class="dropdown-item" href="{{ route('admin.settings') }}">
                                            {{ __('Settings') }}
                                        </a>
                                        <a class="dropdown-item" href="{{ route('admin.users') }}">
                                            {{ __('Users') }}
                                        </a>
                                        <a class="dropdown-item" href="{{ route('admin.administrators') }}">
                                            {{ __('Administrators') }}
                                        </a>
                                        <a class="dropdown-item" href="{{ route('admin.products') }}">
                                            {{ __('Products') }}
                                        </a>
                                        <a class="dropdown-item" href="{{ route('admin.messages') }}">
                                            {{ __('Messages') }}
                                        </a>
                                        <a class="dropdown-item" href="{{ route('admin.logout') }}">
                                            {{ __('Logout') }}
                                        </a>
                                    @endif
                                    

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

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
