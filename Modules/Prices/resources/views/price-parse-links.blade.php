@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link" aria-current="page" href="/prices"><i class="bi bi-arrow-left-short"></i> Назад</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="/price-parse/{{$price_uploaded['id']}}">Связать Позиции</a>
            </li>
        </ul>
        <h1 class="h2">Прайс-лист {{$price_uploaded['price_name']}}</h1>
    </div>

    <!-- Settings Modal -->
    <div class="modal fade" id="settingsPrice" tabindex="-1" aria-labelledby="settingsPrice"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="settingsPrice">Настройки прайс-листа для загрузки в
                        систему</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('updateUploadPrice') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="text" class="form-control price_id" id="price_id"
                               name="price_id" value="price_id" hidden>
                        <input type="text" class="form-control currency_id" id="currency_id"
                               name="currency_id" value="currency_id" hidden>
                        <div class="row">
                            <div class="col mb-3">
                                <label for="name" class="col-form-label">Название:</label>
                                <input type="text" class="form-control name" id="name"
                                       name="name" aria-label=".form-control-sm example">
                            </div>
                            <div class="col mb-3">
                                <label for="currency" class="col-form-label">Валюта:</label>
                                <input class="form-control currency" list="datalistCurrency" id="currency"
                                       name="currency" placeholder="Введите валюту ...">
                                <datalist id="datalistCurrency">
                                    @foreach($currencies as $currency)
                                        <option data-id="{{ $currency['id'] }}"
                                                value="{{ $currency['name']}} {{ $currency['code'] }}">
                                    @endforeach
                                </datalist>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-1">
                                <input type="text" class="form-control sheet_name" id="sheet_name"
                                       name="sheet_name" aria-label=".form-control-sm example">
                                <div id="sheet_name" class="form-text">Названия листа, где размещен прайс
                                </div>
                            </div>
                            <div class=" col mb-3">
                                <input type="text" class="form-control numeration_started"
                                       id="numeration_started"
                                       name="numeration_started" aria-label=".form-control-sm example">
                                <div id="numeration_started" class="form-text">Номер строки где размещено
                                    наименование
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div><h5>Наименование товара:</h5></div>
                            <div class="col mb-3">
                                <input type="text" class="form-control model_name" id="model_name"
                                       name="model_name" aria-label=".form-control-sm"
                                       aria-describedby="model_name">
                                <div id="model_name" class="form-text">Название колонки с наименованием</div>
                            </div>
                            <div class="col mb-3">
                                <input type="text" class="form-control price_name" id="price_name"
                                       name="price_name" aria-label=".form-control-sm"
                                       aria-describedby="price_name">
                                <div id="price_name" class="form-text">Название колонки с ценой</div>
                            </div>
                            <div class="col mb-3">
                                <input type="text" class="form-control qty_name" id="qty_name"
                                       name="qty_name" aria-label=".form-control-sm"
                                       aria-describedby="qty_name">
                                <div id="qty_name" class="form-text">Название колонки с колличеством</div>
                            </div>
                        </div>
                        <div><h5>Дополнительное поле:</h5></div>
                        <div class="mb-3">
                            <input type="text" class="form-control additional" id="additional"
                                   name="additional" aria-label=".form-control-sm"
                                   aria-describedby="additional">
                            <div id="additional" class="form-text">Любое название колонки из прайса</div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                Закрыть
                            </button>
                            <button type="submit" id="settingsPrice-submit" class="btn btn-primary">
                                Сохранить настроки
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Update File -->
    <form action="{{route('updateFile')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="modal fade" id="updateFile" tabindex="-1" role="dialog" aria-labelledby="updateFile"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="updateFile">Загрузка прйс-листа в систему</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="text" class="form-control price_id" id="price_id"
                               name="price_id" value="price_id" hidden>
                        <input type="file" name="file" id="update-file" hidden/>
                        <label class="file-upload" for="update-file"> <span>  <i class="bi bi-filetype-xls"></i> Выбрать файл</span></label>
                        <div id="update-file-filename"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" value="submit" class="btn btn-primary">Обновить</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <!-- Canvas -->
    <div class="offcanvas offcanvas-end" tabindex="-1" id="linkProductCanvas" aria-labelledby="linkProduct">
        <input type="text" class="offcanvas price_model_id" id="price_model_id"
               name="price_model_id" value="price_model_id" hidden>
        <div class="offcanvas-header">
            <h5 id="productName">Выбор продукта для связи</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <div class="fs-4 text-center mb-4" id="priceModel"></div>
            <div class="container text-center">
                <div class="m-3">
                    <table class="table table-sm table-hover table-bordered" id="linkProductTable">
                        <thead>
                        <td>Похожие модели</td>
                        </thead>
                        <tbody id="linkProductName"></tbody>
                    </table>
                </div>
                <label for="product-select" class="form-label">Или выбирите из списка</label>
                <div class="input-group">
                    <input class="form-control" list="datalistOptions"
                           data-id="{{$price_uploaded['id']}}" id="product-select"
                           placeholder="Введите название модели ...">
                    <button type="button" class="btn btn-outline-secondary btn-sm" onclick="getIdOfDatalist()">Связать
                    </button>
                    <datalist id="datalistOptions">
                        @foreach($products as $product)
                            <option data-value="{{ $product['id'] }}" value="{{ $product['model'] }}">
                        @endforeach
                    </datalist>
                </div>
            </div>
        </div>
    </div>

    <!-- Buttons -->
    <div class="d-flex justify-content-between mb-2 form-group">
        <div class="btn-group btn-group-sm p-2 bd-highlight" role="group">
            <button type="button" id="update_file" class="btn btn-outline-secondary update_file"
                    onclick="return updateFile({{$price_uploaded['id']}})">Обновить файл
            </button>
            <button type="button" id="parse_price" class="btn btn-outline-info parse_price"
                    onclick="return parsePrice({{$price_uploaded['id']}})">Распарсить
            </button>
            <button type="button" id="settings_price" class="btn btn-outline-secondary settings_price"
                    onclick="return settingsPrice({{$price_uploaded['id']}})"><i class="bi bi-gear"></i>
            </button>
        </div>

        <div class="d-flex flex-row-reverse justify-content">
            <div class="input-group p-2">
                <span class="input-group-text" id="basic-addon1"><i class="bi bi-search"></i></span>
                <input type="text" class="form-control" id="customSearchPriceParse" style="width:220px;"
                       placeholder="Поиск по наименованию ..." aria-label="customSearchPriceParse" aria-describedby="basic-addon1">
            </div>
        </div>
    </div>

    <!-- Modal Wait Parse -->
    <div class="modal fade" id="modalWaitParse" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
         aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header d-flex align-items-center">
                    <strong role="status">Ожидайте... </strong>
                    <div class="spinner-border ms-auto" aria-hidden="true"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Table -->
    <div class="tab-content" id="myTabContent">

        <table
                id="tablePriceParse"
                class="table table-sm sp-table"
                data-locale="ru-RU"
                data-toggle="table"
                data-unique-id="id"
                data-checkbox-header="false"
                data-ajax="ajaxRequest"
                data-search="true"
                data-search-selector="#customSearchPriceParse"
                data-side-pagination="server"
                data-pagination="true"
                data-page-size="15"
                data-page-list="[15, 25, 50]"
                data-server-sort="false"
                data-query-params="queryParams"
                data-response-handler="responseHandler"
                data-row-style="rowStyle"
                data-id="{{$price_uploaded['id']}}">
            <thead>
            <tr>
                <th data-field="id" data-sortable="true">ID</th>
                <th data-field="is_link" data-checkbox="true">Связь</th>
                <th data-field="price_model_name" data-sortable="true">Наименование</th>
                <th data-field="product.model" data-cell-style="cellStyle" data-sortable="true">Связка Каталог</th>
                <th data-field="price_parse.additional" data-sortable="true">Доп. инфо</th>
                <th data-field="price_parse.quantity">К-во</th>
                <th data-field="price_parse.price">Цена</th>
                <th data-field="price_parse.price_uploaded.currency.code">Валюта</th>
            </tr>
            </thead>
        </table>
    </div>

    <script src="/js/components/price.js"></script>
@endsection