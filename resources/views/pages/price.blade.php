@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Прайс-лист {{$price_uploaded['price_name']}}</h1>
        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <strong>{{ $message }}</strong>
            </div>
        @endif
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <button type="button" id="find_product" class="btn btn-outline-secondary find_product"
                onclick="return addProduct()"
        >Распознать
        </button>
        <button type="button" id="add_product" class="btn btn-outline-secondary add_product"
                onclick="return addProduct()"
        >Добавить позицию
        </button>
        <button type="button" id="update_file" class="btn btn-outline-secondary update_file"
                onclick="return updateFile({{$price_uploaded['id']}})"
        >Обновить файл
        </button>
        <button type="button" id="parse_price" class="btn btn-outline-info parse_price"
                onclick="return parsePrice({{$price_uploaded['id']}})">
            Распарсить
        </button>
        <div class="btn-toolbar mb-2 mb-md-0">
            <button type="button" id="settings_price" class="btn btn-outline-secondary settings_price"
                    onclick="return settingsPrice({{$price_uploaded['id']}})"
            >Настройки
            </button>
        </div>
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

    <table class="table table-hover table-bordered">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Связь</th>
            <th scope="col">Наименование</th>
            <th scope="col">Связка Каталог</th>
            <th scope="col">Дополнительная информация</th>
            <th scope="col">К-во</th>
            <th scope="col">Цена</th>
        </tr>
        </thead>
        @foreach($price as $key=>$item)
            <tbody onclick="alert('123')">
            <tr>
                <th scope="row">{{$key+1}}</th>
                <td></td>
                <td>{{$item['model']}}</td>
                <td></td>
                <td>{{$item['additional']}}</td>
                <td>{{$item['quantity']}}</td>
                <td>{{$item['price']}}</td>
            </tr>
            </tbody>
        @endforeach
    </table>
@endsection