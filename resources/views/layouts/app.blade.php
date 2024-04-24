<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <title></title>
    @include('includes.head')
</head>
<body class="d-flex flex-column h-100">
<header class="py-3 mb-3">
    @include('includes.header')
</header>
<div class="container-fluid">
    <div class="row flex-grow-sm-1 flex-grow-0">
        <aside class="col-sm-2 flex-grow-sm-1 flex-shrink-1 flex-grow-0 pb-sm-0 pb-3">
            <div class="col-sm-2 bg-light h-100 position-fixed border-end">
                @auth
                    @include('sidebar_menu')
                @endauth
            </div>
        </aside>
        <main class="col overflow-auto h-100">
            <div class="bg-light p-3">
                @yield('content')
            </div>
        </main>
    </div>
</div>

<footer class="row">
    {{--   @include('includes.footer')--}}
</footer>
</body>
</html>










