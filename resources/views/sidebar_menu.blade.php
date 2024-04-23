<nav class="nav flex-column side-menu">
    <a class="nav-link px-2 align-middle {{(request()->path()=="home") ? "active" : null}}" aria-current="page"
       href="/home">
        <i class="fs-4 bi-house"></i><span class="ms-1 d-none d-sm-inline">Home</span>
    </a>
    <a href="#catalogMenu" data-bs-toggle="collapse" class="nav-link px-2 align-middle">
        <i class="fs-4 bi-grid"></i><span class="ms-1 d-none d-sm-inline">Каталог <i id="catalogCollapse" class="bi bi-chevron-down"></i></span>
    </a>
    <ul class="collapse nav flex-column ms-1
    {{
    (request()->path()=="products" || request()->path()=="categories" ||
       request()->path()=="brands" || request()->path()=="currency" || request()->path()=="margin")
       ? "show" : null
    }}" id="catalogMenu" data-bs-parent="#menu">
        <div>
        <li>
            <a href="/products" class="nav-link px-4 {{(request()->path()=="products") ? "active" : null}}"> <span
                        class="d-none d-sm-inline">Продукты</span></a>
        </li>
        <li>
            <a href="/categories" class="nav-link px-4 {{(request()->path()=="categories") ? "active" : null}}"> <span
                        class="d-none d-sm-inline">Категории</span></a>
        </li>
        <li>
            <a href="/brands" class="nav-link px-4 {{(request()->path()=="brands") ? "active" : null}}"> <span
                        class="d-none d-sm-inline">Бренды</span></a>
        </li>
        <li>
            <a href="/margin" class="nav-link px-4 {{(request()->path()=="margin") ? "active" : null}}"> <span
                        class="d-none d-sm-inline">Наценка</span></a>
        </li>
        <li>
            <a href="/currency" class="nav-link px-4 {{(request()->path()=="currency") ? "active" : null}}"> <span
                        class="d-none d-sm-inline">Валюта</span></a>
        </li>
        </div>
    </ul>
    <a href="/prices" class="nav-link px-2 align-middle {{( str_contains(request()->path(), 'price')) ? "active" : null}}">
        <i class="fs-4 bi-file-text"></i><span class="ms-1 d-none d-sm-inline">Прайс-листы</span></a>
    <a href="/sellers" class="nav-link px-2 align-middle {{(request()->path()=="sellers") ? "active" : null}}">
        <i class="fs-4 bi-truck"></i><span class="ms-1 d-none d-sm-inline">Поставщики</span></a>
</nav>
<script src="/js/components/navMenu.js"></script>