@extends('prices::price-parse-links')

@section('price-table')
    <table class="table table-sm table-hover table-bordered sp-table align-middle">
        <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Связь</th>
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
                    <input class="check-input" type="checkbox" id="is_link" data-id="{{ $item->price_id }}"
                           value="{{ $item->is_link }}" {{$item->is_link == 1 ? 'checked' : ''}}>
                    </td>
                <td>{{$item->priceParse->model}}</td>
                <td class="cursor-table" onClick="linkListProduct('{{ $item->priceParse->id }}', '{{ $item->priceParse->model}}')">
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
@endsection