@extends('layouts.app')

@section('content')
    @php
    var_dump(flash()->message)
    @endphp
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Категории</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <button type="button" class="custom-file-upload" data-bs-toggle="modal" data-bs-target="#createCategory">
                Создать
            </button>

            <!-- Create Category -->
            <form action="{{route('createCategory')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal fade" id="createCategory" tabindex="-1" aria-labelledby="createCategory"
                     aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="createCategory">Создать</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div>
                                    <label for="name" class="col-form-label"><h5>Название категории</h5></label>
                                    <input type="text" class="form-control name" id="name"
                                           name="name" aria-label=".form-control-sm example" required>
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

            <!-- Update Category -->
            <div class="modal fade" id="updateCategory" tabindex="-1" aria-labelledby="updateCategory"
                 aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="updateCategory">Обновить</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <input type="text" class="form-control category_id" id="category_id"
                                   name="category_id" value="category_id" hidden>
                            <div>
                                <label for="name" class="col-form-label">Название Категории</label>
                                <input type="text" class="form-control name" id="name" name="name" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                            <button type="button" class="btn btn-primary buttonUpdateCategory">Обновить</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- Custom Search Categories -->
    <div class="d-flex flex-row-reverse justify-content">
        <div class="input-group w-auto p-2">
            <input type="text" class="form-control" id="customSearchCategories" style="width:220px;"
                   placeholder="Поиск по категории ..." aria-label="customSearchCategories"
                   aria-describedby="basic-addon1">
            <span class="input-group-text reset-search" id="basic-addon1" onclick="checkIcon()"><i
                        class="bi bi-x-lg"></i></span>
        </div>
    </div>

    <div>
        <table
                id="tableCategories"
                class="table table-sm sp-table"
                data-locale="ru-RU"
                data-toggle="table"
                data-unique-id="id"
                data-checkbox-header="false"
                data-ajax="ajaxRequest"
                data-search="true"
                data-search-selector="#customSearchCategories"
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
                <th data-field="name">Категория</th>
                <th data-field="created_at" data-formatter="formDateValueTable">Дата создания</th>
                <th data-field="operate" data-formatter="operateFormatter" data-events="operateEvents">Действие</th>
            </tr>
            </thead>
        </table>
    </div>

    <script src="/js/components/categories.js"></script>
@endsection