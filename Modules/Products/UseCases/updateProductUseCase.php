<?php

namespace Modules\Products\UseCases;

use App\Traits\Makeable;
use Modules\Products\Http\Requests\UpdateProductRequest;
use Modules\Products\Models\Products;

class updateProductUseCase
{
    use Makeable;

    public function execute(UpdateProductRequest $request)
    {
        $data = $request->all();

        $product = Products::findOrFail($data['product_id']);
        $message = '';

        if (!$product) {
            throw new \Exception('Not found');
        }

        if (isset($data['model'])) {
            $product->sku             = $data['sku'];
            $product->category_id     = $data['category_id'];
            $product->brand_id        = $data['brand_id'];
            $product->model           = $data['model'];
            $product->localization_id = $data['localization_id'];
            $product->package         = $data['package'];
            $product->condition       = $data['condition'];
            $product->update();

            $message = 'Продукт обновлен!';
        }

        $product->get()->toArray();

        return response()->json([
            'type'    => 'success',
            'message' => $message,
            'product' => $product,
        ]);
    }

}