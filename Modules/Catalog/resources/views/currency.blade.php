@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Валюта</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <button type="button" class="custom-file-upload" data-bs-toggle="modal" data-bs-target="#createCurrency">
                Создать
            </button>

            <!-- Create Currency -->
            <form action="{{route('createCurrency')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal fade" id="createCurrency" tabindex="-1" aria-labelledby="createCurrency"
                     aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="createCurrency">Создать</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div>
                                    <div>
                                        <label for="name" class="col-form-label">Валюта*</label>
                                        <input type="text" class="form-control name" id="name" name="name" required>
                                    </div>
                                    <div>
                                        <label for="code" class="col-form-label">Код Валюты*</label>
                                        <input type="text" class="form-control code" id="code" name="code" required>
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

            <!-- Update Currency -->
            <form action="{{route('updateCurrency')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal fade" id="updateCurrency" tabindex="-1" aria-labelledby="updateCurrency"
                     aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="updateCurrency">Обновить</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <input type="text" class="form-control currency_id" id="currency_id"
                                       name="currency_id" value="currency_id" hidden>
                                <div>
                                    <label for="name" class="col-form-label">Валюта</label>
                                    <input type="text" class="form-control name" id="name" name="name" required>
                                </div>
                                <div>
                                    <label for="code" class="col-form-label">Код Валюты</label>
                                    <input type="text" class="form-control code" id="code" name="code" required>
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
                <th scope="col">Валюта</th>
                <th scope="col">Код Валюты</th>
                <th scope="col" class="col-2">Дата создания</th>
                <th scope="col" class="col-2">Действия</th>
            </tr>
            </thead>
            @foreach($currencies as $key=>$item)
                <tbody>
                <tr>
                    <th scope="row">{{$item['id']}}</th>
                    <td>{{$item['name']}}</td>
                    <td>{{$item['code']}}</td>
                    <td>{{date('d-m-Y', strtotime($item['created_at']))}}</td>
                    <td>
                        <button type="button" id="updateCurrency" data-id="{{$item['id']}}"
                                class="btn btn-sm btn-lg btn-outline-success updateCurrency">
                            <i class="bi bi-pencil-square"></i>
                        </button>
                        <button type="button" id="deleteCurrency" data-id="{{$item['id']}}"
                                class="btn btn-sm btn-lg btn-outline-danger deleteCurrency"
                                onclick="return confirm('Подтвердить удаление?')">
                            <i class="bi bi-trash3"></i>
                        </button>
                    </td>
                </tr>
                </tbody>
            @endforeach
        </table>
    </div>
    <div class="d-felx justify-content-center">
        {{ $currencies->links() }}
    </div>

    <script src="/js/components/currency.js"></script>
@endsection

