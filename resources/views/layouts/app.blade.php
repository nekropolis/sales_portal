<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <title></title>
    @include('includes.head')
</head>
<body>
<div class="container">
    <header id="app">
        @include('includes.header')
    </header>
    <div id="main" class="row">
        <div class="col-2 pt-3">
            @auth
                @include('sidebar_menu')
            @endauth
        </div>
        <main class="col-10">
            @yield('content')
        </main>
    </div>
    <footer class="row">
        {{--   @include('includes.footer')--}}
    </footer>
</div>
</body>
</html>










