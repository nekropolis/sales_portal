@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link" aria-current="page" href="/prices"><i class="bi bi-arrow-left-short"></i> Назад</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Прайс-Лист</a>
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
                        <div class="mb-3">
                            <label for="name" class="col-form-label">Название прайс-листа:</label>
                            <input type="text" class="form-control name" id="name"
                                   name="name" aria-label=".form-control-sm example">
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

    <!-- Add Product -->
    <form action="{{route('updateFile')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="modal fade" id="addProduct" tabindex="-1" role="dialog" aria-labelledby="addProduct"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="updateFile">Добавить продукт к прайс-листу</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                    </div>
                    <div class="modal-footer">
                        <button type="submit" value="submit" class="btn btn-primary">Добавить</button>
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
            <button type="button" id="add_product" class="btn btn-outline-secondary add_product"
                    onclick="return addProduct()">Добавить позицию
            </button>
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

        <!-- Search -->
        <form action="/price-parse/{{$price_uploaded['id']}}" method="get">
            <div class="input-group">
                <input
                        type="text"
                        id="search"
                        data-id="{{$price_uploaded['id']}}"
                        name="q"
                        class="form-control"
                        placeholder="Поиск..."
                        value="{{ request('q') }}"
                        aria-label="Example input"
                        aria-describedby="button-addon1"
                />
                <button data-mdb-button-init data-mdb-ripple-init class="btn btn-sm btn-lg btn-outline-primary"
                        type="submit" id="button-addon1" data-mdb-ripple-color="dark">
                    <i class="bi bi-search"></i> GO
                </button>
            </div>
        </form>
    </div>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade" id="price-tab-pane" role="tabpanel" aria-labelledby="price-tab" tabindex="0">...
        </div>
        <div class="tab-pane fade show active" id="link-tab-pane" role="tabpanel" aria-labelledby="link-tab"
             tabindex="0">
            <table class="table table-sm table-hover table-bordered sp-table align-middle">
                <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col" onClick="return sortIsLink({{$price_uploaded['id']}})">Связь</th>
                    <th scope="col">Наименование</th>
                    <th scope="col">Связка Каталог</th>
                    <th scope="col">Дополнительная информация</th>
                    <th scope="col">К-во</th>
                    <th scope="col">Цена</th>
                </tr>
                </thead>
                @foreach($price as $key=>$item)
                    {{--            @php
                                dd($item);
                                @endphp--}}
                    <tbody>
                    <tr class="{{$item->is_link == 1 ? 'table-success' : ''}}">
                        <th scope="row">{{$item->id}}</th>
                        <td class="cursor-table">
                            <input class="check-input" type="checkbox" id="is_link"
                                   data-id="{{ $item->price_model_id }}"
                                   value="{{ $item->is_link }}" {{$item->is_link == 1 ? 'checked' : ''}}>
                        </td>
                        <td>{{$item->priceParse->model}}</td>
                        <td class="cursor-table"
                            onClick="linkListProduct('{{ $item->priceParse->id }}', '{{ $item->priceParse->model}}')">
                            @if ($item->product !== null)
                                {{$item->product->brand->name}} {{$item->product->model}}
                            @else
                                Не нашлось совпадения
                            @endif
                        </td>
                        <td>{{$item->priceParse->additional}}</td>
                        <td>{{$item->priceParse->quantity}}</td>
                        <td>{{$item->priceParse->price}}</td>
                    </tr>
                    </tbody>
                @endforeach
            </table>
            <div class="d-felx justify-content-center">
                @if($showPagination)
                    {{ $price->links() }}
                @endif
            </div>
        </div>
    </div>

    <script src="/js/components/price.js"></script>
@endsection