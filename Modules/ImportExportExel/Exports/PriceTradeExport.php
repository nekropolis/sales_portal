<?php

namespace Modules\ImportExportExel\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Modules\Prices\Models\Inventories;

class PriceTradeExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $sameModel = Inventories::selectRaw('product_id, min(price) as price')
            ->groupBy('product_id');

        return Inventories::join(DB::raw('('.$sameModel->toSql().') as sub'), function ($join) {
            $join->on('sub.price', '=', 'inventories.price');
            $join->on('sub.product_id', '=', 'inventories.product_id');
        })
            ->with('priceParse')
            ->with('product')
            ->with('currency')
            ->with('product.brand')
            ->with('product.category')
            ->get()
            ->map(function ($item) {
                return [
                    'id'           => $item->id,
                    'sku'          => $item->product->sku,
                    'brand'        => $item->product->brand->name,
                    'category'     => $item->product->category->name,
                    'model'        => $item->product->model,
                    'localization' => $item->product->localization,
                    'package'      => $item->product->package,
                    'condition'    => $item->product->condition,
                    'qty'          => $item->qty,
                    'price'        => $item->price,
                    'currency'     => $item->currency->code,
                ];
            });
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function headings(): array
    {
        return [
            "ID", "SKU", "Категория", "Бренд", "Модель", "Локализация", "Комплектация", "Состояние", "Наличие", "Цена",
            "Валюта",
        ];
    }
}
