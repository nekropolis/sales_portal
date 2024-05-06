@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link" href="/trade-price">Прайс-Лист</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="/trade-price-settings">Настройки</a>
            </li>
        </ul>
        <h1 class="h2">Трейд Зона Настройки</h1>
    </div>

    <div class="d-flex justify-content-between mb-2 form-group">
        <div class="btn-group btn-group-sm p-2 bd-highlight" role="group">
            <button type="button" id="update_file" class="btn btn-outline-secondary update_file"
                    onclick="return createRules()">Создать правило
            </button>
            <button type="button" id="parse_price" class="btn btn-outline-info parse_price"
                    onclick="return parsePrice()">Дублировать
            </button>
            <button type="button" id="settings_price" class="btn btn-outline-secondary settings_price"
                    onclick="return settingsPrice()"><i class="bi bi-gear"></i>
            </button>
        </div>
    </div>

    <table class="table table-responsive">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Активный</th>
            <th scope="col">Поставщик</th>
            <th scope="col">Прайс</th>
            <th scope="col">Валюта</th>
        </tr>
        </thead>
        @foreach($sellers as $seller)
            <tbody>
            <tr>
                <td>{{$seller->id}}</td>
                <td>{{$seller->is_active == true ? 'Да': 'Отключен'}}</td>
                <td>{{$seller->seller->name}}</td>
                <td>{{$seller->name}}</td>
                <td>{{$seller->currency->code}}</td>
            </tr>
            </tbody>
        @endforeach
    </table>

    <script src="/js/components/priceTrade.js"></script>
@endsection