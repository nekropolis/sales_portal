@extends('layouts.app')

@section('content')
    <!-- Modal addPrice-->
    <form action="{{route('createUploadPrice')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="modal fade" id="addPrice" tabindex="-1" aria-labelledby="addPriceLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="addPriceLabel">Загрузка прйс-листа в систему</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <select name="seller_name" class="form-select mb-3" aria-label="Default select example"
                                required>
                            <option value="" selected hidden>Выбирете поставщика *</option>
                            @foreach($sellers as $seller)
                                <option data-val={{ $seller['id'] }} value="{{ $seller['id'] }}">{{ $seller['name'] }} </option>
                            @endforeach
                        </select>
                        <div class="col mb-3">
                            <label for="currency" class="col-form-label">Валюта: *</label>
                            <input class="form-control currency" list="datalistCurrency" id="currency"
                                   name="currency" placeholder="Введите валюту ..." required>
                            <datalist id="datalistCurrency">
                                @foreach($currencies as $currency)
                                    <option data-id="{{ $currency['id'] }}" value="{{ $currency['code'] }}">
                                @endforeach
                            </datalist>
                        </div>
                        <label for="name" class="col-form-label">Название прайс-листа: *</label>
                        <input type="text" id="name" name="name" class="form-control name mb-3"
                               placeholder="Введите название" required>
                        <input type="file" name="file" id="file-upload" hidden/>
                        <label class="file-upload" for="file-upload"> <span>  <i class="bi bi-filetype-xls"></i> Выбрать файл *</span></label>
                        <div id="file-upload-filename"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Закрыть</button>
                        <button type="submit" class="btn btn-outline-primary">Загрузить</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <!-- Custom Search Categories -->
    <div class="d-flex justify-content-between flex-wrap">
        <button type="button" class="custom-file-upload" data-bs-toggle="modal" data-bs-target="#addPrice">
            Добавить новый прайс
        </button>
        <div class="input-group w-auto p-2">
            <input type="text" class="form-control" id="customSearchUploadPrices" style="width:220px;"
                   placeholder="Поиск ..." aria-label="customSearchUploadPrices"
                   aria-describedby="basic-addon1">
            <span class="input-group-text reset-search" id="basic-addon1" onclick="checkIcon()"><i
                        class="bi bi-x-lg"></i></span>
        </div>
    </div>

    <!-- Table -->
    <div class="tab-content" id="myTabContent">

        <table
                id="tableUploadPrices"
                class="table table-sm sp-table"
                data-locale="ru-RU"
                data-toggle="table"
                data-unique-id="id"
                data-checkbox-header="false"
                data-ajax="ajaxRequest"
                data-search="true"
                data-row-style="rowStyle"
                data-search-selector="#customSearchUploadPrices"
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
                <th data-field="is_active" data-checkbox="true">Активный</th>
                <th data-field="seller.name" data-sortable="true">Поставщик</th>
                <th data-field="orig_name" data-sortable="true">Прайс</th>
                <th data-field="name" data-cell-style="cellStyle" data-sortable="true">Названия прайса в системе</th>
                <th data-field="status">Статус</th>
                <th data-field="updated_at" data-formatter="formDateValueTable">Дата загрузки</th>
                <th data-field="operate" data-formatter="operateFormatter" data-events="operateEvents">Действие</th>
            </tr>
            </thead>
        </table>
    </div>

    <script src="/js/components/uploadPrices.js"></script>
@endsection

