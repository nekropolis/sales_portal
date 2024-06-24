<?php

namespace Modules\Prices\UseCases;

use Illuminate\Http\Request;
use Modules\Prices\Models\LinkPrices;

class IsLinkUseCase
{
    public function execute(Request $request)
    {
        $data = $request->param;

        $isLinkData = [];
        if (isset($data['checkbox'])) {
            LinkPrices::where('id', $data['price_id'])->update([
                'is_link' => $data['checkbox'],
            ]);
            $isLinkData = LinkPrices::where('id', $data['price_id'])
                ->where('is_exist', 1)
                ->with('priceParse')
                ->with('priceParse.priceUploaded.currency')
                ->with('product')
                ->with('product.brand')
                ->first();
        }
        if (isset($data['product_id'])) {
            LinkPrices::where('price_model_id', $data['price_id'])->update([
                'product_id' => $data['product_id'],
                'is_link'    => 1,
            ]);
            $isLinkData = LinkPrices::where('price_model_id', $data['price_id'])
                ->where('is_exist', 1)
                ->with('priceParse')
                ->with('priceParse.priceUploaded.currency')
                ->with('product')
                ->with('product.brand')
                ->first();
        }

        return $isLinkData;
    }
}