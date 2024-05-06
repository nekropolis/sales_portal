<?php

namespace Modules\TradeZone\UseCases;


use App\Traits\Makeable;
use Illuminate\Http\Request;

use Modules\Prices\Models\Inventories;
use Modules\Prices\Models\LinkPrices;

class formTradePriceUseCase
{
    use Makeable;

    public function execute(Request $request)
    {

        $collections = LinkPrices::where(['is_link' => true, 'is_exist' => true])
            ->whereHas('priceParse.priceUploaded', function ($query) {
                $query->where('is_active', true);
            })
            ->with('priceParse.priceUploaded.currency')
            ->with('product')
            ->with('product.brand')
            ->get();

        //dd($collections);

        $price = [];
        foreach ($collections as $item) {
            //dd($item->priceParse->qty);

            $dataToUpdate = [
                'price_model_name' => $item->price_model_name,
                'price'            => $item->priceParse->price,
                'margin_id'        => 5,
                'currency_id'      => $item->priceParse->priceUploaded->currency_id,
                'qty'              => $item->priceParse->quantity,
            ];

            $price = Inventories::query()->updateOrCreate([
                'product_id'     => $item->product_id,
                'price_model_id' => $item->price_model_id,
            ], $dataToUpdate);
        }

        dd($price);
    }
}