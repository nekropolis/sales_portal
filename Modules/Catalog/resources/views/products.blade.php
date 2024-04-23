@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Продукты</h1>
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
        <button type="button" class="custom-file-upload" data-bs-toggle="modal" data-bs-target="#createProduct">
            Создать
        </button>
        <form action="{{ route('products.import') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <input type="file" name="file" class="form-control">

            <br>
            <button class="btn btn-success"><i class="fa fa-file"></i> Import User Data</button>
        </form>
    </div>

    <div>

        <!-- Search -->
        <div class="d-flex flex-row-reverse justify-content">
            <form action="/products" method="get">
                <div class="input-group w-auto form-group">
                    <input
                            type="text"
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
                                <select name="brand" class="form-select mb-3" aria-label="Default select example">
                                    <option value="0" selected>Любой</option>
                                    @foreach($brands as $brand)
                                        <option data-val={{ $brand['id'] }} value="{{ $brand['id'] }}">{{ $brand['name'] }} </option>
                                    @endforeach
                                </select>
                                <div id="brand" class="form-text">Бренд</div>
                            </div>
                            <div class="col">
                                <select id="category" name="category" class="form-select mb-3"
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
                                <input type="text" class="form-control model_name" id="localization"
                                       name="localization" aria-label=".form-control-sm"
                                       aria-describedby="localization">
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

    <table class="table table-sm table-hover table-bordered sp-table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">SKU</th>
            <th scope="col">Категория</th>
            <th scope="col">Бренд</th>
            <th scope="col">Модель</th>
            <th scope="col">Локализация</th>
            <th scope="col">Комплектация</th>
            <th scope="col">Состояние</th>
            <th scope="col" class="col-1">Действия</th>
        </tr>
        </thead>
        @foreach($products as $key=>$product)
            <tbody>
            <tr>
                <th scope="row">{{$key+1}}</th>
                <td>{{$product['sku']}}</td>
                <td>{{$product['category']['name']}}</td>
                <td>{{$product['brand']['name']}}</td>
                <td>{{$product['model']}}</td>
                <td>{{$product['localization']}}</td>
                <td>{{$product['package']}}</td>
                <td>{{$product['condition']}}</td>
                <td>
                    <button type="button"
                            class="btn btn-sm btn-lg btn-outline-success">
                        <i class="bi bi-pencil-square"></i>
                    </button>
                    <button type="button"
                            class="btn btn-sm btn-lg btn-outline-danger">
                        <i class="bi bi-trash3"></i>
                    </button>
                </td>
            </tr>
            </tbody>
        @endforeach
    </table>
    <div class="d-felx justify-content-center">
        @if($showPagination)
        {{ $products->links() }}
        @endif
    </div>
@endsection