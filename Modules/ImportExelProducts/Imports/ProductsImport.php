<?php

namespace Modules\ImportExelProducts\Imports;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Modules\Catalog\Models\Brands;
use Modules\Catalog\Models\Categories;
use Modules\Catalog\Models\Products;

class ProductsImport implements ToModel, WithHeadingRow, WithValidation
{
    /**
     * @param  array  $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        //dd($brand->id);

        if($row['model'] !== null) {
            $brand = Brands::where('name', $row['brend'])->first();
            $category = Categories::where('name', $row['kategoriia'])->first();

            return new Products([
                'brand_id'    => $brand->id,
                'category_id' => $category->id,
                'model'       => $row['model'],
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