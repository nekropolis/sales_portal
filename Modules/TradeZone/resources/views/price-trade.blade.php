@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link active" href="/trade-price">Прайс-Лист</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/trade-price-settings">Настройки</a>
            </li>
        </ul>
        <h1 class="h2">Трейд Зона</h1>
    </div>


    <!-- Buttons -->
    <div class="d-flex justify-content-between mb-2 form-group">
        <div class="btn-group btn-group-sm p-2 bd-highlight" role="group">
            <form action="{{ route('priceTrade.export') }}" method="GET" enctype="multipart/form-data">
                @csrf
                <button class="btn btn-outline-secondary" type="submit">Экспорт Прайс-Листа</button>
            </form>
        </div>
        <!-- Search -->
        <div class="d-flex flex-row-reverse justify-content">
            <div class="input-group w-auto p-2">
                <input type="text" class="form-control" id="customSearchTradeZone" style="width:220px;"
                       placeholder="Поиск по модели ..." aria-label="customSearchTradeZone"
                       aria-describedby="basic-addon1">
                <span class="input-group-text reset-search" id="basic-addon1" onclick="checkIcon()"><i class="bi bi-x-lg"></i></span>
            </div>
        </div>
    </div>

    <!-- Table -->
    <div class="tab-content" id="myTabContent">

        <table
                id="tableTradeZone"
                data-locale="ru-RU"
                class="table table-sm sp-table"
                data-search-selector="#customSearchTradeZone"
                data-toggle="table"
                data-unique-id="id"
                data-checkbox-header="false"
                data-ajax="ajaxRequest"
                data-search="true"
                data-side-pagination="server"
                data-pagination="true"
                data-page-size="15"
                data-page-list="[15, 25, 50]"
                data-server-sort="false"
                data-detail-view="true"
                data-detail-view-icon="false"
                data-detail-formatter="detailFormatter"
                data-query-params="queryParams"
                data-response-handler="responseHandler">
            <thead>
            <tr>
                <th data-field="icon" class="detail" data-formatter="detailIconFormatter" data-events="detailIconEvents"></th>
                <th data-field="id" data-halign="center" data-sortable="true">ID</th>
                <th data-field="product.sku">SKU</th>
                <th data-field="product.category.name" data-sortable="true">Категория</th>
                <th data-field="product.brand.name" data-sortable="true">Бренд</th>
                <th data-field="product.model" data-sortable="true">Модель</th>
                <th data-field="product.localization">Локализация</th>
                <th data-field="product.package">Комплектация</th>
                <th data-field="product.condition">Состояние</th>
                <th data-field="qty">Наличие</th>
                <th data-field="price" data-sortable="true">Цена</th>
                <th data-field="currency.code">Валюта</th>
            </tr>
            </thead>
        </table>
    </div>

    <script src="/js/components/priceTrade.js"></script>
@endsection