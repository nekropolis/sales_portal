<?php

namespace Modules\ImportExelProducts\Exports;

use Modules\Catalog\Models\Products;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProductsExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Products::select("id", "sku", "brand_id", "category_id", "model")->get();
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function headings(): array
    {
        return ["ID", "sku", "Brand", "Category", "Model"];
    }
}
