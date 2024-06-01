<?php

namespace Modules\Catalog\UseCases;

use App\Traits\Makeable;
use Modules\Catalog\Http\Requests\UpdateProductRequest;
use Modules\Catalog\Models\Products;

class updateProductUseCase
{
    use Makeable;

    public function execute(UpdateProductRequest $request)
    {
        $data = $request->all();

        //dd($data);
        $product = Products::findOrFail($data['product_id']);
        if (!$product) {
            throw new \Exception('Not found');
        }

        if (isset($data['model'])) {
            $product->sku          = $data['sku'];
            $product->category_id  = $data['category_id'];
            $product->brand_id     = $data['brand_id'];
            $product->model        = $data['model'];
            $product->localization = $data['localization'];
            $product->package      = $data['package'];
            $product->condition    = $data['condition'];
            $product->update();

            return Products::where('id', $data['product_id'])->with('category')->with('brand')->first();
        } else {
            $product->get()->toArray();

            return $product;
        }
    }

}