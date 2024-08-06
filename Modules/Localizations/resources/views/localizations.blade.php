@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Локализация</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <button type="button" class="custom-file-upload" data-bs-toggle="modal" data-bs-target="#createLocalization">
                Создать
            </button>

            <!-- Create Localization -->
            <form action="{{route('createLocalization')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal fade" id="createLocalization" tabindex="-1" aria-labelledby="createLocalization" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="createLocalization">Создать</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div>
                                    <label for="name" class="col-form-label"><h5>Локализация</h5></label>
                                    <input type="text" class="form-control name" id="name"
                                           name="name" aria-label=".form-control-sm" required>
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

            <!-- Update Localization -->
            <div class="modal fade" id="updateLocalization" tabindex="-1" aria-labelledby="updateLocalization" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="updateLocalization">Обновить</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <input type="text" class="form-control localization_id" id="localization_id"
                                   name="localization_id" value="localization_id" hidden>
                            <div>
                                <label for="name" class="col-form-label">Локализация</label>
                                <input type="text" class="form-control name" id="name" name="name" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                            <button type="button" class="btn btn-primary buttonUpdateLocalization">Обновить</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- Custom Search Localizations -->
    <div class="d-flex flex-row-reverse justify-content">
        <div class="input-group w-auto p-2">
            <input type="text" class="form-control" id="customSearchLocalizations" style="width:220px;"
                   placeholder="Поиск ..." aria-label="customSearchLocalizations"
                   aria-describedby="basic-addon1">
            <span class="input-group-text reset-search" id="basic-addon1" onclick="checkIcon()"><i
                        class="bi bi-x-lg"></i></span>
        </div>
    </div>

    <div>
        <table
                id="tableLocalizations"
                class="table table-sm sp-table"
                data-locale="ru-RU"
                data-toggle="table"
                data-unique-id="id"
                data-checkbox-header="false"
                data-ajax="ajaxRequest"
                data-search="true"
                data-search-selector="#customSearchLocalizations"
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
                <th data-field="name">Локализация</th>
                <th data-field="created_at" data-formatter="formDateValueTable">Дата создания</th>
                <th data-field="operate" data-formatter="operateFormatter" data-events="operateEvents">Действие</th>
            </tr>
            </thead>
        </table>
    </div>

        <script src="/js/components/localizations.js"></script>
@endsection

