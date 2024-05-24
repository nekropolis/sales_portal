<?php

namespace Modules\ImportExportExel\Exports;

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
        return Products::with(['category', 'brand'])
            ->get()
            ->map(function ($item) {
                return [
                    'id'       => $item->id,
                    'sku'      => $item->sku,
                    'brand'    => $item->brand->name,
                    'category' => $item->category->name,
                    'model'    => $item->model,
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
        return ["ID", "sku", "Brand", "Category", "Model"];
    }
}
