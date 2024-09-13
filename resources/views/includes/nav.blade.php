<nav class="navbar navbar-expand px-4 py-3">
    @include('layouts.flash-messages')
    @php
    $prices    = \Modules\Prices\Models\PricesUploaded::query()->pluck('id', 'name')->toArray();
    $idPrice   = strstr(request()->path(), '/');
    $priceId   = str_replace('/', '', $idPrice);
    $priceName = array_search($priceId, $prices);

    //var_dump(array_search($ttes, $prices), )
    @endphp
    @switch(request()->path())
        @case('trade-price')
            <h4>Трейд Зона</h4>
        @break

        @case('trade-price-settings')
            <h4>Трейд Зона - Настройки</h4>
            @break

        @case('sellers')
            <h4>Поставщики</h4>
            @break

        @case('products')
            <h4>Продукты</h4>
            @break

        @case('categories')
            <h4>Категории</h4>
            @break

        @case('brands')
            <h4>Бренды</h4>
            @break

        @case('localizations')
            <h4>Локализация</h4>
            @break

        @case('currency')
            <h4>Валюта</h4>
            @break

        @case('prices')
            <h4>Прайс-листы</h4>
            @break

        @case('price-parse'.$idPrice)
            <h4>Прйс-Лист {{$priceName}}</h4>
            @break

        @case('users')
            <h4>Пользователи</h4>
            @break

        @default
            <h5>RuPrice</h5>
    @endswitch

    <form action="#" class="d-none d-sm-inline-block">

    </form>
    <div class="navbar-collapse collapse">
        <!-- Right Side Of Navbar -->
        <ul class="navbar-nav ms-auto">
            <!-- Authentication Links -->
            @guest
                @if (Route::has('login'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                @endif

                @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                    </li>
                @endif
            @else
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                       data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }}
                    </a>
                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="#">
                            Профиль
                        </a>
                    </div>
                </li>
            @endguest
        </ul>
    </div>
</nav>