<?php

namespace Modules\ImportExportExel\Imports;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Modules\Brands\Models\Brands;
use Modules\Categories\Models\Categories;
use Modules\Products\Models\Products;

class ProductsImport implements ToModel, WithHeadingRow, WithValidation
{
    /**
     * @param  array  $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        if($row['model'] !== null) {
            $brand = Brands::where('name', $row['brend'])->first();
            $category = Categories::where('name', $row['kategoriia'])->first();

            return Products::query()->updateOrCreate([
                'model'       => $row['model'],
            ], [
                'brand_id'    => $brand->id ?? 0,
                'category_id' => $category->id ?? 0,
            ]);
        }
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function rules(): array
    {
        return [
            //'model' => 'required',
        ];
    }
}