@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Категории</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <button type="button" class="custom-file-upload" data-bs-toggle="modal" data-bs-target="#createCategory">
                Создать
            </button>

            <!-- Create Category -->
            <form action="{{route('createCategory')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal fade" id="createCategory" tabindex="-1" aria-labelledby="createCategory" aria-hidden="true">
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
            <form action="{{route('updateCategory')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal fade" id="updateCategory" tabindex="-1" aria-labelledby="updateCategory" aria-hidden="true">
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
                <th scope="col" class="col-1">ID</th>
                <th scope="col">Категория</th>
                <th scope="col" class="col-2">Дата создания</th>
                <th scope="col" class="col-2">Действия</th>
            </tr>
            </thead>
            @foreach($categories as $key=>$category)
                <tbody>
                <tr>
                    <th scope="row">{{$category['id']}}</th>
                    <td>{{$category['name']}}</td>
                    <td>{{date('d-m-Y', strtotime($category['created_at']))}}</td>
                    <td>
                        <button type="button" id="updateCategory" data-id="{{$category['id']}}"
                                class="btn btn-sm btn-lg btn-outline-success updateCategory">
                            <i class="bi bi-pencil-square"></i>
                        </button>
                        <button type="button" id="deleteCategory" data-id="{{$category['id']}}"
                                class="btn btn-sm btn-lg btn-outline-danger deleteCategory"
                                onclick="return confirm('Подтвердить удаление?')">
                            <i class="bi bi-trash3"></i>
                        </button>
                    </td>
                </tr>
                </tbody>
            @endforeach
        </table>
    </div>

    <script src="/js/components/categories.js"></script>
@endsection