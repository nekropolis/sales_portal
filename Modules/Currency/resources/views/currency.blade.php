@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Валюта</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <button type="button" class="custom-file-upload" data-bs-toggle="modal" data-bs-target="#createCurrency">
                Создать
            </button>

            <!-- Create Currency -->
            <form action="{{route('createCurrency')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal fade" id="createCurrency" tabindex="-1" aria-labelledby="createCurrency"
                     aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="createCurrency">Создать</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div>
                                    <div>
                                        <label for="name" class="col-form-label">Валюта*</label>
                                        <input type="text" class="form-control name" id="name" name="name" required>
                                    </div>
                                    <div>
                                        <label for="code" class="col-form-label">Код Валюты*</label>
                                        <input type="text" class="form-control code" id="code" name="code" required>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                                <button type="submit" class="btn btn-primary">Добавить</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

            <!-- Update Currency -->
            <div class="modal fade" id="updateCurrency" tabindex="-1" aria-labelledby="updateCurrency"
                 aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="updateCurrency">Обновить</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <input type="text" class="form-control currency_id" id="currency_id"
                                   name="currency_id" value="currency_id" hidden>
                            <div>
                                <label for="name" class="col-form-label">Валюта</label>
                                <input type="text" class="form-control name" id="name" name="name" required>
                            </div>
                            <div>
                                <label for="code" class="col-form-label">Код Валюты</label>
                                <input type="text" class="form-control code" id="code" name="code" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                            <button type="submit" class="btn btn-primary buttonUpdateCurrency">Обновить</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="d-flex flex-row-reverse justify-content">
        <div class="input-group w-auto p-2">
            <input type="text" class="form-control" id="customSearchCurrency" style="width:220px;"
                   placeholder="Поиск по категории ..." aria-label="customSearchCurrency"
                   aria-describedby="basic-addon1">
            <span class="input-group-text reset-search" id="basic-addon1" onclick="checkIcon()"><i
                        class="bi bi-x-lg"></i></span>
        </div>
    </div>

    <div>
        <table
                id="tableCurrency"
                class="table table-sm sp-table"
                data-locale="ru-RU"
                data-toggle="table"
                data-unique-id="id"
                data-checkbox-header="false"
                data-ajax="ajaxRequest"
                data-search="true"
                data-search-selector="#customSearchCurrency"
                data-side-pagination="server"
                data-pagination="true"
                data-page-size="15"
                data-page-list="[15, 25, 50]"
                data-server-sort="false"
                data-query-params="queryParams"
                data-response-handler="responseHandler"
                data-row-style="rowStyle">
            <thead>
            <tr>
                <th data-field="id" data-halign="center" data-sortable="true">ID</th>
                <th data-field="name">Валюта</th>
                <th data-field="code">Код</th>
                <th data-field="created_at" data-formatter="formDateValueTable">Дата создания</th>
                <th data-field="operate" data-formatter="operateFormatter" data-events="operateEvents">Действие</th>
            </tr>
            </thead>
        </table>
    </div>

    <script src="/js/components/currency.js"></script>
@endsection

