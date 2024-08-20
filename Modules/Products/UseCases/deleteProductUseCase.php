<?php

namespace Modules\Products\UseCases;

use App\Traits\Makeable;
use Modules\Prices\Models\Elastic;
use Modules\Prices\Models\LinkPrices;
use Modules\Products\Http\Requests\DeleteProductRequest;
use Modules\Products\Models\Products;
use Modules\TradeZone\Models\PriceModelsInProduct;

class deleteProductUseCase
{
    use Makeable;

    public function execute(DeleteProductRequest $request)
    {
        $data = $request->all();

        $inventorProduct = Elastic::where('product_id', $data['product_id']);
        $inventorProduct->delete();

        $parseModelProduct = PriceModelsInProduct::where('product_id', $data['product_id']);
        $parseModelProduct->delete();

        $linkProducts = LinkPrices::where('product_id', $data['product_id'])->get();
        foreach ($linkProducts as $linkProduct) {
            $linkProduct->product_id = 0;
            $linkProduct->is_link    = 0;
            $linkProduct->update();
        }

        $product = Products::findOrFail($data['product_id']);
        $product->delete();

        return response()->json([
            'type'    => 'success',
            'message' => 'Продукт удален!',
        ]);
    }
}