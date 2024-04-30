@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Прайс-листы</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <form action="{{route('fileUpload')}}" method="post" enctype="multipart/form-data">
                @csrf
                <button type="button" class="custom-file-upload" data-toggle="modal" data-target="#addPrice">
                    Добавить новый прайс
                </button>

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
                                <select name="seller_name" class="form-select mb-3" aria-label="Default select example">
                                    <option selected>Выбирете поставщика</option>
                                    @foreach($sellers as $seller)
                                        <option data-val={{ $seller['id'] }} value="{{ $seller['id'] }}">{{ $seller['name'] }} </option>
                                    @endforeach
                                </select>
                                <label for="name" class="col-form-label">Название прайс-листа:</label>
                                <input type="text" id="name" name="name" class="form-control name mb-3"
                                       placeholder="Введите название">
                                <input type="file" name="file" id="file-upload" hidden/>
                                <label class="file-upload" for="file-upload"> <span>  <i class="bi bi-filetype-xls"></i> Выбрать файл</span></label>
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

    <div>
        <table class="table table-sm table-hover table-bordered sp-table">
            <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Активный</th>
                <th scope="col">Поставщик</th>
                <th scope="col">Прайс</th>
                <th scope="col">Названия прайса в системе</th>
                <th scope="col">Статус</th>
                <th scope="col">Дата загрузки</th>
                <th scope="col">Действие</th>
            </tr>
            </thead>
            @foreach($prices as $key=>$price)
                <tbody>
                <tr class="{{$price['is_active'] == 1 ? 'table-success' : ''}}">
                    <th scope="row">{{$price['id']}}</th>
                    <td class="active-price">
                        <input class="check-input" type="checkbox" id="is_link"
                               data-id="{{ $price['id'] }}"
                               value="{{ $price['is_active'] }}" {{$price['is_active'] == 1 ? 'checked' : ''}}>
                    </td>
                    <td>{{$price['seller_name']}}</td>
                    <td>{{$price['orig_name']}}</td>
                    <td class="cursor-table" onclick="window.location='{{ route('getPriceParse', $price['id']) }}'">
                        <i class="bi bi-box-arrow-in-right"></i> {{$price['name']}} <i class="bi bi-folder2-open"></i>
                    </td>
                    <td>{{$price['status']}}</td>
                    <td>{{date('d-m-Y H:i', strtotime($price['updated_at']))}}</td>
                    <td>
                        <button type="button" id="delete_price" data-id="{{$price['id']}}"
                                class="btn btn-sm btn-lg btn-outline-danger delete_price">
                            <i class="bi bi-trash3"></i>
                        </button>
                    </td>
                </tr>
                </tbody>
            @endforeach
        </table>
    </div>

    <script src="/js/components/uploadPrices.js"></script>
@endsection

