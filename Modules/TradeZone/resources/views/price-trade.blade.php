@extends('layouts.app')

@section('content')
    <!-- Buttons -->
    <div class="d-flex justify-content-between mb-2">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link active" href="/trade-price">Прайс-Лист</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/trade-price-settings">Настройки</a>
            </li>
        </ul>
        <div class="btn-toolbar mb-2" role="toolbar" aria-label="Toolbar with button groups">
            <div class="input-group me-3">
                <!-- Search -->
                <input type="text" class="form-control" id="customSearchTradeZone" style="width:220px;"
                       placeholder="Поиск ..." aria-label="customSearchTradeZone"
                       aria-describedby="basic-addon1">
                <span class="input-group-text reset-search" id="basic-addon1" onclick="checkIcon()"><i
                            class="bi bi-x-lg"></i></span>
            </div>
            <div class="btn-group" role="group" aria-label="First group">
                <form action="{{ route('priceTrade.export') }}" method="GET" enctype="multipart/form-data">
                    @csrf
                    <button class="btn btn-outline-secondary" title="Скчать прайс-лист" type="submit">
                        <i class="lni lni-upload"></i>
                    </button>
                </form>
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
                <th data-field="icon" class="detail" data-formatter="detailIconFormatter"
                    data-events="detailIconEvents"></th>
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