<?php

namespace Modules\ImportExelProducts\Exports;

use Illuminate\Support\Facades\DB;
use Modules\Catalog\Models\Products;
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

        $qwer = Inventories::join(DB::raw('('.$sameModel->toSql().') as sub'), function ($join) {
            $join->on('sub.price', '=', 'inventories.price');
            $join->on('sub.product_id', '=', 'inventories.product_id');
        })
            ->with('priceParse')
            ->with('product')
            ->with('currency')
            ->with('product.brand')
            ->with('product.category')
            ->get();

        dd($qwer);

        return Products::select("id", "sku", "brand_id", "category_id", "model")->get();
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function headings(): array
    {
        return ["ID", "SKU", "Категория", "Бренд", "Модель", "Локализация", "Комплектация", "Состояние", "Наличие", "Цена", "Валюта"];
    }
}
