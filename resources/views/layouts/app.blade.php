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
    <div class="row flex-nowrap">
        @auth
            <div class="col-auto col-md-3 col-xl-2">
                @include('sidebar_menu')
            </div>
        @endauth
        <div class="col py-3 px-sm-3">
            @yield('content')
        </div>
    </div>
</div>
<footer class="row">
    {{--   @include('includes.footer')--}}
</footer>
</body>
</html>










