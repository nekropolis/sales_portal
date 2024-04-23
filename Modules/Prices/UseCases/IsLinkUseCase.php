<?php

namespace Modules\Prices\UseCases;

use Illuminate\Http\Request;
use Modules\Prices\Models\LinkPrices;

class IsLinkUseCase
{
    public function execute(Request $request)
    {
        $data = $request->param;

        //dd($data, isset($data['checkbox']), isset($data['product_id']), !empty($data['checkbox']), !empty($data['product_id']));

        if (isset($data['checkbox'])) {
            return LinkPrices::where('price_id', $data['price_id'])->update([
                'is_link' => $data['checkbox'],
            ]);
        }
        if (isset($data['product_id'])) {
            return LinkPrices::where('price_id', $data['price_id'])->update([
                'product_id' => $data['product_id'],
            ]);
        }
    }
}