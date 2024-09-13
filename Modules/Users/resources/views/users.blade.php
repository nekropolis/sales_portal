@extends('layouts.app')

@section('content')
    <!-- Buttons -->
    <div class="d-flex justify-content-between mb-2 form-group">
        <button type="button" class="custom-file-upload" data-bs-toggle="modal" data-bs-target="#addUser">
            Создать пользователя
        </button>
        <!-- Search -->
        <div class="d-flex flex-row-reverse justify-content">
            <div class="input-group w-auto p-2">
                <input type="text" class="form-control" id="customSearchUsers" style="width:220px;"
                       placeholder="Поиск ..." aria-label="customSearchUsers"
                       aria-describedby="basic-addon1">
                <span class="input-group-text reset-search" id="basic-addon1" onclick="checkIcon()"><i class="bi bi-x-lg"></i></span>
            </div>
        </div>
    </div>

    <!-- Modal Add Seller-->
    <form action="{{route('createUser')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="modal fade" id="addUser" tabindex="-1" aria-labelledby="addUser" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="addUser">Создать</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
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

    <!-- Table -->
    <div class="tab-content" id="myTabContent">
        <table
                id="tableUsers"
                data-locale="ru-RU"
                class="table table-sm sp-table"
                data-search-selector="#customSearchUsers"
                data-toggle="table"
                data-unique-id="id"
                data-checkbox-header="false"
                data-ajax="ajaxRequest"
                data-search="true"
                data-side-pagination="server"
                data-pagination="true"
                data-page-size="15"
                data-page-list="[15, 25, 50]"
                data-server-sort="false"
                data-detail-view="true"
                data-detail-view-icon="false"
                data-detail-formatter="detailFormatter"
                data-query-params="queryParams"
                data-response-handler="responseHandler">
            <thead>
            <tr>
                <th data-field="icon" class="detail" data-formatter="detailIconFormatter" data-events="detailIconEvents"></th>
                <th data-field="id" data-halign="center" data-sortable="true">ID</th>
                <th data-field="name">Имя</th>
                <th data-field="email" data-sortable="true">Email</th>
                <th data-field="created_at" data-formatter="formDateValueTable">Дата создания</th>
                <th data-field="operate" data-formatter="operateFormatter" data-events="operateEvents">Действие</th>
            </tr>
            </thead>
        </table>
    </div>

    <script src="/js/components/users.js"></script>
@endsection