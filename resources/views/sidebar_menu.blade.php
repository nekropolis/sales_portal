<aside id="sidebar" class="expand">
    <div class="d-flex">
        <button class="toggle-btn" type="button">
            <i class="lni lni-grid-alt"></i>
        </button>
        <div class="sidebar-logo">
            <a href="#">RuPrice</a>
        </div>
    </div>
    <ul class="sidebar-nav">
        <li class="sidebar-item">
            <a href="#catalogMenu" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse"
               data-bs-target="#catalogMenu" aria-expanded="false" aria-controls="catalogMenu">
                <i class="lni lni-briefcase-alt"></i>
                <span>Каталог</span>
            </a>
            <ul id="catalogMenu" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                <li class="sidebar-item">
                    <a href="/products" class="sidebar-link {{(request()->path()=="products") ? "active" : null}}">
                        Продукты
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="/categories" class="sidebar-link {{(request()->path()=="categories") ? "active" : null}}">
                        Категории
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="/brands" class="sidebar-link {{(request()->path()=="brands") ? "active" : null}}">
                        Бренды
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="/localizations"
                       class="sidebar-link {{(request()->path()=="localizations") ? "active" : null}}">
                        Локализация
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="/currency" class="sidebar-link {{(request()->path()=="currency") ? "active" : null}}">
                        Валюта
                    </a>
                </li>
            </ul>
        </li>
        <li class="sidebar-item">
            <a href="/trade-price"
               class="sidebar-link {{ str_starts_with(request()->path(), 'trade-price') ? "active" : null}}">
                <i class="lni lni-customer"></i>
                <span>Трейд Зона</span>
            </a>
        </li>
        <li class="sidebar-item">
            <a href="#sellersMenu" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse"
               data-bs-target="#sellersMenu" aria-expanded="false" aria-controls="sellersMenu">
                <i class="lni lni-clipboard"></i>
                <span>Работа с Прайсами</span>
            </a>
            <ul id="sellersMenu" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                <li class="sidebar-item">
                    <a href="/prices" class="sidebar-link {{( str_starts_with(request()->path(), 'price-parse') || str_starts_with(request()->path(), 'prices')) ? "active" : null}}">
                        Прайс-листы
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="/sellers" class="sidebar-link {{(request()->path()=="sellers") ? "active" : null}}">
                        Поставщики
                    </a>
                </li>
            </ul>
        </li>
        <li class="sidebar-item">
            <a href="/users"
               class="sidebar-link {{ str_starts_with(request()->path(), 'users') ? "active" : null}}">
                <i class="lni lni-user"></i><span>Пользователи</span>
            </a>
        </li>
    </ul>
    <div class="sidebar-footer">
        <a href="#" class="sidebar-link">
            <i class="lni lni-exit"></i>
            <span>Logout</span>
        </a>
    </div>
</aside>
<script src="/js/components/navMenu.js"></script>