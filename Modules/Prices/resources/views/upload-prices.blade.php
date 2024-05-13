@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Прайс-листы</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <button type="button" class="custom-file-upload" data-toggle="modal" data-target="#addPrice">
                Добавить новый прайс
            </button>

            <!--Form Price Upload -->
            <form action="{{route('createUploadPrice')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal fade" id="addPrice" tabindex="-1" role="dialog" aria-labelledby="addPrice"
                     aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="addPrice">Загрузка прйс-листа в систему</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body-upload">
                                <select name="seller_name" class="form-select mb-3" aria-label="Default select example" required>
                                    <option value="" selected hidden>Выбирете поставщика *</option>
                                    @foreach($sellers as $seller)
                                        <option data-val={{ $seller['id'] }} value="{{ $seller['id'] }}">{{ $seller['name'] }} </option>
                                    @endforeach
                                </select>
                                <label for="name" class="col-form-label">Название прайс-листа: *</label>
                                <input type="text" id="name" name="name" class="form-control name mb-3"
                                       placeholder="Введите название" required>
                                <input type="file" name="file" id="file-upload" hidden/>
                                <label class="file-upload" for="file-upload"> <span>  <i class="bi bi-filetype-xls"></i> Выбрать файл *</span></label>
                                <div id="file-upload-filename"></div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" value="submit" class="btn btn-primary">Загрузить</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
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
               {{-- data-search-selector="#customSearchPriceParse"--}}
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
                <th data-field="updated_at">Дата загрузки</th>
                <th data-field="operate" data-formatter="operateFormatter" data-events="operateEvents">Действие</th>
            </tr>
            </thead>
        </table>
    </div>

    <script src="/js/components/uploadPrices.js"></script>
@endsection

