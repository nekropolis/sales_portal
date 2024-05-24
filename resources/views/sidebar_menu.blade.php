<nav class="nav d-flex flex-column align-items-center align-items-sm-start px-1 min-vh-100 sticky-top sticky-offset side-menu">
    <a class="nav-link px-2 align-middle {{(request()->path()=="home") ? "active" : null}}" aria-current="page"
       href="/home">
        <i class="fs-5 bi-house"></i><span class="ms-1 d-none d-sm-inline">Home</span>
    </a>
    <a href="#catalogMenu" data-target="#catalogMenu" data-bs-toggle="collapse" class="nav-link px-2 align-middle">
        <i class="fs-5 bi-grid"></i><span class="ms-1 d-none d-sm-inline">Каталог <i id="catalogCollapse" class="bi bi-chevron-down icon-sidebar"></i></span>
    </a>
    <ul class="collapse nav flex-column ms-1
    {{
    (request()->path()=="products" || request()->path()=="categories" ||
       request()->path()=="brands" || request()->path()=="currency")
       ? "show" : null
    }}" id="catalogMenu" data-bs-parent="#menu">
        <div>
        <li>
            <a href="/products" class="nav-link px-4 {{(request()->path()=="products") ? "active" : null}}">
                <i class="bi bi-bag"></i><span class="d-none d-sm-inline"> Продукты</span></a>
        </li>
        <li>
            <a href="/categories" class="nav-link px-4 {{(request()->path()=="categories") ? "active" : null}}">
                <i class="bi bi-collection"></i><span class="d-none d-sm-inline"> Категории</span></a>
        </li>
        <li>
            <a href="/brands" class="nav-link px-4 {{(request()->path()=="brands") ? "active" : null}}">
                <i class="bi bi-journals"></i><span class="d-none d-sm-inline"> Бренды</span></a>
        </li>
        <li>
            <a href="/currency" class="nav-link px-4 {{(request()->path()=="currency") ? "active" : null}}">
                <i class="bi bi-cash-coin"></i><span class="d-none d-sm-inline"> Валюта</span></a>
        </li>
        </div>
    </ul>
    <a href="/trade-price" class="nav-link px-2 align-middle {{ str_starts_with(request()->path(), 'trade-price') ? "active" : null}}">
        <i class="fs-5 bi-clipboard-data"></i><span class="ms-1 d-none d-sm-inline">Трейд Зона</span></a>
    {{--    <a href="/sellers" class="nav-link px-2 align-middle {{(request()->path()=="sellers") ? "active" : null}}">
            <i class="fs-5 bi-truck"></i><span class="ms-1 d-none d-sm-inline">Поставщики</span></a>--}}


    <a href="#sellersMenu" data-bs-toggle="collapse" class="nav-link px-2 align-middle">
        <i class="fs-5 bi-tags"></i><span class="ms-1 d-none d-sm-inline">Работа с Прайсами <i id="sellersCollapse" class="bi bi-chevron-down icon-sidebar"></i></span>
    </a>
    <ul class="collapse nav flex-column ms-1
    {{
    (request()->path()=="prices" || request()->path()=="sellers")
       ? "show" : null
    }}" id="sellersMenu" data-bs-parent="#menu">
        <div>
            <li>
                <a href="/prices" class="nav-link px-4 {{( str_starts_with(request()->path(), 'price-parse') || str_starts_with(request()->path(), 'prices')) ? "active" : null}}">
                    <i class="bi bi-file-earmark-spreadsheet"></i><span class="d-none d-sm-inline"> Прайс-листы</span></a>
            </li>
            <li>
                <a href="/sellers" class="nav-link px-4 {{(request()->path()=="sellers") ? "active" : null}}">
                    <i class="bi-5 bi-truck"></i><span class="d-none d-sm-inline"> Поставщики</span></a>
            </li>
        </div>
    </ul>
</nav>
<script src="/js/components/navMenu.js"></script>