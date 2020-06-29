<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/welcome/style.css') }}" rel="stylesheet">

</head>
<body>
    <nav class="navbar navbar-expand-md navbar-dark bg-dark shadow-sm">
        <div class="container-xl">
            <a class="navbar-brand" href="{{ url('/') }}">
                <img src="/asu-logo.png" alt="logo" class="img-fluid" style="width: 50px;">
            </a>
            <a class="titleLink" href="{{ url('/') }}">
                <div class="title">
                    <span>Система управления процессом организации итоговой государственной аттестации в вузе</span>
                </div>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                    @if (Route::has('login'))
                        @auth
                            @if( isset(Auth::user()->role->slug) )
                                <a href="{{ url(Auth::user()->role->slug) }}" class="nav-link">Учетная запись</a>
                            @else
                                <a href="/" class="nav-link">Учетная запись</a>
                            @endif
                        @else
                            <a href="{{ route('login') }}" class="nav-link">Войти</a>
                        @endauth
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    <main>
        <div class="container-xl">
            <div class="row justify-content-center">
                <div class="col-sm-12 col-md-9 col-lg-10">
                    <div class="welcome border shadow">
                        <div class="welcome-header">
                            <h2>Добро пожаловать!</h2>
                        </div>

                        <div class="welcome-text">
                            <p>
                                Данная система позволит Вам управлять процессом организации итоговой государственной аттестации в вузе.
                            </p>
                            <p>
                                Войдите как зарегистрированный пользователь или узнайте данные учетной записи у сотрудника кафедры, если у вас еще их нет.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

</body>
</html>
