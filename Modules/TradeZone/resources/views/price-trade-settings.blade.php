@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link" href="/trade-price">Прайс-Лист</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="/trade-price-settings">Настройки</a>
            </li>
        </ul>
        <h1 class="h2">Трейд Зона Настройки</h1>
    </div>

    <!-- Create Rule Modal -->
    <div class="modal fade" id="rule" tabindex="-1" aria-labelledby="rule"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('createRuleTradePrice') }}" method="post" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="rule">Создать новое правило</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        @csrf
                        <div class="row">
                            <div class="col">
                                <label for="price_min" class="col-form-label">Мин Цена</label>
                                <input type="number" class="form-control price_min" id="price_min"
                                       name="price_min" aria-label=".form-control-sm example">
                            </div>
                            <div class="col">
                                <label for="price_max" class="col-form-label">Макс Цена</label>
                                <input type="number" class="form-control price_max" id="price_max"
                                       name="price_max" aria-label=".form-control-sm example">
                            </div>
                            <div class="col">
                                <label for="trade_margin" class="col-form-label">Наценка *</label>
                                <input type="text" class="form-control trade_margin" id="trade_margin"
                                       name="trade_margin" aria-label=".form-control-sm example" required>
                                <div id="marginHelp" class="form-text">Пример: 10 или 10%.</div>
                            </div>
                        </div>
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

    <!-- Modal Wait Parse -->
    <div class="modal fade" id="modalWait" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
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

    <!--Buttons -->
    <div class="d-flex justify-content-between mb-2 form-group">
        <button type="button" class="btn btn-outline-secondary btn-sm m-2"
                onclick="return createRules()">Создать правило
        </button>

        <div class="form-group">
            <button type="button" class="btn btn-outline-success btn-sm m-2"
                    onclick="return formPriceTrade()">Сформировать прайс
            </button>
            <span class="align-middle fs-5">Валюта:</span>
            <select id="currencySelect" class="currency-select">
                @foreach($currencies as $currency)
                    <option value={{$currency['id']}} {{$tradeSettings && $tradeSettings->currency_id == $currency['id']  ? 'selected' : ''}}>{{$currency['code']}}</option>
                @endforeach
            </select>
        </div>
    </div>

    <!-- Table -->
    <div class="tab-content">
        <table
                id="tableRules"
                class="table table-sm sp-table"
                data-locale="ru-RU"
                data-toggle="table"
                data-unique-id="id"
                data-checkbox-header="false"
                data-ajax="ajaxRequest"
                data-search="false"
                data-row-style="rowStyle"
                data-side-pagination="server"
                data-pagination="true"
                data-page-size="15"
                data-page-list="[15, 25, 50]"
                data-server-sort="false"
                data-query-params="queryParams"
                data-response-handler="responseHandler">
            <thead>
            <tr>
                <th data-field="id" data-sortable="true">ID</th>
                <th data-field="is_active" data-checkbox="true"></th>
                <th data-field="price_uploaded" data-formatter="selectFormatterPriceUploaded"
                    data-events="selectEventsPriceUploaded">Прайс
                </th>
                <th data-field="price_min" data-formatter="price_minFormatter" data-events="price_minEvents">Мин. Цена
                </th>
                <th data-field="price_max" data-formatter="price_maxFormatter" data-events="price_maxEvents">Макс.
                    Цена
                </th>
                <th data-field="categories" data-formatter="selectFormatterCategory" data-events="selectEventsCategory">
                    Категории
                </th>
                <th data-field="brands" data-formatter="selectFormatterBrand" data-events="selectEventsBrand">Бренды
                </th>
                <th data-field="trade_margin" data-formatter="trade_marginFormatter" data-events="trade_marginEvents">
                    Наценка
                </th>
                <th data-field="sort" data-formatter="sortFormatter" data-events="sortEvents">Приоритет</th>
                <th data-field="operate" data-formatter="deleteFormatter" data-events="deleteEvents">Действие</th>
            </tr>
            </thead>
        </table>
    </div>

    <div class="m-3">
        <H6>Наценка:</H6>
        <div>
            Укажите наценку числом, если хотите прибавить это число к цене продукта. Или добавьте % (пример - 10%) в конце числа, тогда к цене будет прибавляться указанный процент.
        </div>
        <br>
        <H6>Приоритет:</H6>
        <div>
            Правило с наименьшим числом приоритета будет обрабатываться в первую очередь. Правила у которых приортиет выше, при обработке не затрагивают продуты, которые были обработаны с меньшим числом приоритета.
        </div>
    </div>

    <table class="table table-responsive">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Активный</th>
            <th scope="col">Поставщик</th>
            <th scope="col">Прайс</th>
            <th scope="col">Валюта</th>
        </tr>
        </thead>
        @foreach($sellers as $seller)
            <tbody>
            <tr>
                <td>{{$seller->id}}</td>
                <td>{{$seller->is_active == true ? 'Да': 'Отключен'}}</td>
                <td>{{$seller->seller->name}}</td>
                <td>{{$seller->name}}</td>
                <td>{{$seller->currency->code}}</td>
            </tr>
            </tbody>
        @endforeach
    </table>

    <script type="text/javascript">
        window.sellers = {!! json_encode($sellers) !!};
        window.categories = {!! json_encode($categories) !!};
        window.brands = {!! json_encode($brands) !!};
    </script>


    <script src="/js/components/priceTradeSettings.js"></script>
@endsection