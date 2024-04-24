@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Валюта</h1>
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
            <button type="button" class="custom-file-upload" data-bs-toggle="modal" data-bs-target="#createMargin">
                Создать
            </button>

            <!-- Create Brand -->
            <form action="{{route('createMargin')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal fade" id="createMargin" tabindex="-1" aria-labelledby="createMargin" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="createMargin">Modal title</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div>
                                    <div>
                                        <label for="name" class="col-form-label">Группа наценки</label>
                                        <input type="text" class="form-control name" id="name" name="name">
                                    </div>
                                    <div>
                                        <label for="percent" class="col-form-label">Процент наценки</label>
                                        <input type="number" class="form-control percent" id="percent" name="percent">
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

            <!-- Update Brand -->
            <form action="{{route('updateMargin')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal fade" id="updateMargin" tabindex="-1" aria-labelledby="updateMargin" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="updateMargin">Modal title</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <input type="text" class="form-control margin_id" id="margin_id"
                                       name="margin_id" value="margin_id" hidden>
                                <div>
                                    <label for="name" class="col-form-label">Группа наценки</label>
                                    <input type="text" class="form-control name" id="name" name="name">
                                </div>
                                <div>
                                    <label for="percent" class="col-form-label">Процент наценки</label>
                                    <input type="number" class="form-control percent" id="percent" name="percent">
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
                <th scope="col">Группа наценки</th>
                <th scope="col">Процент наценки %</th>
                <th scope="col" class="col-2">Дата создания</th>
                <th scope="col" class="col-2">Действия</th>
            </tr>
            </thead>
            @foreach($margin as $key=>$item)
                <tbody>
                <tr>
                    <th scope="row">{{$item['id']}}</th>
                    <td>{{$item['name']}}</td>
                    <td>{{$item['percent']}}</td>
                    <td>{{date('d-m-Y', strtotime($item['created_at']))}}</td>
                    <td>
                        <button type="button" id="updateMargin" data-id="{{$item['id']}}"
                                class="btn btn-sm btn-lg btn-outline-success updateMargin">
                            <i class="bi bi-pencil-square"></i>
                        </button>
                        <button type="button" id="deleteMargin" data-id="{{$item['id']}}"
                                class="btn btn-sm btn-lg btn-outline-danger deleteMargin"
                                onclick="return confirm('Подтвердить удаление?')">
                            <i class="bi bi-trash3"></i>
                        </button>
                    </td>
                </tr>
                </tbody>
            @endforeach
        </table>
    </div>

    <script src="/js/components/margin.js"></script>
@endsection

