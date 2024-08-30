@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Продукты</h1>

        <form action="{{ route('products.import') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="input-group">
                <input type="file" name="file" id="file-upload" hidden/>
                <label class="form-control" for="file-upload"> <span>  <i class="bi bi-filetype-xls"></i> Выбрать файл *</span></label>
                <div id="file-upload-filename"></div>
                <button type="submit" class="btn btn btn-outline-secondary">Загрузить</button>
            </div>
        </form>


        <form action="{{ route('products.export') }}" method="GET" enctype="multipart/form-data">
            @csrf
            <button class="btn btn-outline-secondary" type="submit">Экспорт Каталога</button>
        </form>
    </div>

    <div>
        <div class="d-flex justify-content-between mb-2 form-group">
            <div class="btn-group btn-group-sm p-2 bd-highlight" role="group">
                <button type="button" class="btn btn-outline-secondary update_file"
                        data-bs-toggle="modal" data-bs-target="#createProduct">Создать
                </button>
            </div>
            <!-- Search -->
            <div class="d-flex flex-row-reverse justify-content">
                <div class="input-group w-auto p-2">
                    <input type="text" class="form-control" id="customSearchProduct" style="width:220px;"
                           placeholder="Поиск по модели ..." aria-label="customSearchProduct"
                           aria-describedby="basic-addon1">
                    <span class="input-group-text reset-search" id="basic-addon1" onclick="checkIcon()">
                        <i class="bi bi-x-lg"></i></span>
                </div>
            </div>
        </div>

        <!-- Create Product -->
        <form action="{{route('createProduct')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="modal fade" id="createProduct" tabindex="-1" aria-labelledby="createProduct" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="createProduct">Новый Продукт</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col">
                                    <select id="brand_id" name="brand_id" class="form-select mb-3"
                                            aria-label="Default select example">
                                        <option value="0" selected>Любой</option>
                                        @foreach($brands as $brand)
                                            <option data-val={{ $brand['id'] }} value="{{ $brand['id'] }}">{{ $brand['name'] }} </option>
                                        @endforeach
                                    </select>
                                    <div id="brand_id" class="form-text">Бренд</div>
                                </div>
                                <div class="col">
                                    <select id="category_id" name="category_id" class="form-select mb-3"
                                            aria-label="Default select example">
                                        <option value="0" selected>Любая</option>
                                        @foreach($categories as $category)
                                            <option data-val={{ $category['id'] }} value="{{ $category['id'] }}">{{ $category['name'] }} </option>
                                        @endforeach
                                    </select>
                                    <div id="category_id" class="form-text">Категория</div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="model" class="col-form-label"><h5>Наименование продукта *</h5></label>
                                <input type="text" class="form-control model" id="model"
                                       name="model" aria-label=".form-control-sm example" required>
                            </div>
                            <div class="row">
                                <div><h5>Дополнительная информация:</h5></div>
                                <div class="col mb-1">
                                    <input type="text" class="form-control sku" id="sku"
                                           name="sku" aria-label=".form-control-sm"
                                           aria-describedby="sku">
                                    <div id="sku" class="form-text">sku/серийный номер</div>
                                </div>
                                <div class="col mb-1">
                                    <select id="localization_id" name="localization_id" class="form-select mb-3 localization_id"
                                            aria-label="Default select example">
                                        <option value="0" selected>Любая</option>
                                        @foreach($localizations as $localization)
                                            <option data-val={{ $localization['id'] }} value="{{ $localization['id'] }}">{{ $localization['name'] }} </option>
                                        @endforeach
                                    </select>
                                    <div id="localization_id" class="form-text">Локализация</div>
                                </div>
                                <div class="col mb-1">
                                    <input type="text" class="form-control condition" id="condition"
                                           name="condition" aria-label=".form-control-sm"
                                           aria-describedby="condition">
                                    <div id="condition" class="form-text">Состояние</div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="package" class="form-label">Комплектация</label>
                                <textarea name="package" class="form-control" id="package" rows="3"></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                            <button type="submit" class="btn btn-primary">Создать</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <!-- Update Product -->
        <div class="modal fade" id="updateProduct" tabindex="-1" aria-labelledby="updateProduct" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="updateProduct">Modal title</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="text" class="form-control product_id" id="product_id"
                               name="product_id" value="product_id" hidden>
                        <div class="row">
                            <div class="col">
                                <select name="brand_id" class="form-select mb-3 brand_id"
                                        aria-label="Default select example">
                                    <option value="0" selected>Любой</option>
                                    @foreach($brands as $brand)
                                        <option data-val={{ $brand['id'] }} value="{{ $brand['id'] }}">{{ $brand['name'] }} </option>
                                    @endforeach
                                </select>
                                <div id="brand" class="form-text">Бренд</div>
                            </div>
                            <div class="col">
                                <select id="category_id" name="category_id" class="form-select mb-3 category_id"
                                        aria-label="Default select example">
                                    <option value="0" selected>Любая</option>
                                    @foreach($categories as $category)
                                        <option data-val={{ $category['id'] }} value="{{ $category['id'] }}">{{ $category['name'] }} </option>
                                    @endforeach
                                </select>
                                <div id="category" class="form-text">Категория</div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="model" class="col-form-label"><h5>Наименование продукта</h5></label>
                            <input type="text" class="form-control model" id="model"
                                   name="model" aria-label=".form-control-sm example">
                        </div>
                        <div class="row">
                            <div><h5>Дополнительная информация:</h5></div>
                            <div class="col mb-1">
                                <input type="text" class="form-control sku" id="sku"
                                       name="sku" aria-label=".form-control-sm"
                                       aria-describedby="sku">
                                <div id="sku" class="form-text">sku/серийный номер</div>
                            </div>
                            <div class="col mb-1">
                                <select id="localization_id" name="localization_id" class="form-select mb-3 localization_id"
                                        aria-label="Default select example">
                                    <option value="0" selected>Любая</option>
                                    @foreach($localizations as $localization)
                                        <option data-val={{ $localization['id'] }} value="{{ $localization['id'] }}">{{ $localization['name'] }} </option>
                                    @endforeach
                                </select>
                                <div id="localization" class="form-text">Локализация</div>
                            </div>
                            <div class="col mb-1">
                                <input type="text" class="form-control condition" id="condition"
                                       name="condition" aria-label=".form-control-sm"
                                       aria-describedby="condition">
                                <div id="condition" class="form-text">Состояние</div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="package" class="form-label">Комплектация</label>
                            <textarea name="package" class="form-control package" id="package" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                        <button type="button" class="btn btn-primary buttonUpdateProduct">Обновить</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Table -->
        <div class="tab-content" id="myTabContent">

            <table
                    id="tableProducts"
                    class="table table-sm sp-table"
                    data-locale="ru-RU"
                    data-toggle="table"
                    data-filter-control="true"
                    data-click-to-select="true"
                    data-unique-id="id"
                    data-checkbox-header="false"
                    data-ajax="ajaxRequest"
                    data-search="true"
                    data-search-selector="#customSearchProduct"
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
                    <th data-field="id" data-halign="center">ID</th>
                    <th data-field="sku">SKU</th>
                    <th data-field="category.name" data-filter-control="select">Категория</th>
                    <th data-field="brand.name">Бренд</th>
                    <th data-field="model">Модель</th>
                    <th data-field="localization.name">Локализация</th>
                    <th data-field="package">Комплектация</th>
                    <th data-field="condition">Состояние</th>
                    <th data-field="operate" data-formatter="operateFormatter" data-events="operateEvents">Действие</th>
                </tr>
                </thead>
            </table>
        </div>

        <script src="/js/components/products.js"></script>
@endsection