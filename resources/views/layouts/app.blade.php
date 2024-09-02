<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title></title>
    @include('includes.head')
</head>
<body>
<div class="wrapper">
    @auth
        @include('sidebar_menu')
    @endauth
    <div class="main">
        @include('includes.nav')
        <main class="content px-3 py-4">
            <div class="container-fluid">
                <div class="mb-3">
                    @yield('content')
                </div>
            </div>
        </main>
        <footer class="footer">
            @include('includes.footer')
        </footer>
    </div>
</div>
</body>
</html>