@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Бренды</h1>
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
        <div class="btn-toolbar mb-2 mb-md-0">
            <button type="button" class="custom-file-upload" data-bs-toggle="modal" data-bs-target="#createBrand">
                Создать
            </button>

            <!-- Create Brand -->
            <form action="{{route('createBrand')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal fade" id="createBrand" tabindex="-1" aria-labelledby="createBrand" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="createBrand">Modal title</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div>
                                    <label>
                                        <input type="text" id="name" name="name" placeholder="Название бренда"/>
                                    </label>
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

            <!-- Update Brand -->
            <form action="{{route('updateBrand')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal fade" id="updateBrand" tabindex="-1" aria-labelledby="updateBrand" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="updateBrand">Modal title</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <input type="text" class="form-control brand_id" id="brand_id"
                                       name="brand_id" value="brand_id" hidden>
                                <div>
                                    <label for="name" class="col-form-label">Название Бренда</label>
                                    <input type="text" class="form-control name" id="name" name="name">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                                <button type="submit" class="btn btn-primary">Обновить</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

        </div>
    </div>
    <div>
        <table class="table table-sm table-hover table-bordered sp-table">
            <thead>
            <tr>
                <th scope="col" class="col-1">#</th>
                <th scope="col">Бренд</th>
                <th scope="col" class="col-2">Дата создания</th>
                <th scope="col" class="col-2">Действия</th>
            </tr>
            </thead>
            @foreach($brands as $key=>$brand)
                <tbody>
                <tr>
                    <th scope="row">{{$key+1}}</th>
                    <td>{{$brand['name']}}</td>
                    <td>{{date('d-m-Y', strtotime($brand['created_at']))}}</td>
                    <td>
                        <button type="button" id="updateBrand" data-id="{{$brand['id']}}"
                                class="btn btn-sm btn-lg btn-outline-success updateBrand">
                            <i class="bi bi-pencil-square"></i>
                        </button>
                        <button type="button" id="delete_brand" data-id="{{$brand['id']}}"
                                class="btn btn-sm btn-lg btn-outline-danger delete_brand"
                                onclick="return confirm('Подтвердить удаление?')">
                            <i class="bi bi-trash3"></i>
                        </button>
                    </td>
                </tr>
                </tbody>
            @endforeach
        </table>
    </div>

    <script src="/js/components/brands.js"></script>
@endsection

