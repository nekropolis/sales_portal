<?php

namespace Modules\Catalog\UseCases;

use App\Traits\Makeable;
use Modules\Catalog\Http\Requests\DeleteProductRequest;
use Modules\Catalog\Models\Products;
use Modules\Prices\Models\Inventories;
use Modules\Prices\Models\LinkPrices;
use Modules\TradeZone\Models\PriceModelsInProduct;

class deleteProductUseCase
{
    use Makeable;

    public function execute(DeleteProductRequest $request)
    {
        $data = $request->all();

        $inventorProduct = Inventories::where('product_id', $data['product_id']);
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
    }
}