<?php

namespace Modules\TradeZone\UseCases;

use App\Traits\Makeable;
use Illuminate\Http\Request;
use Mgcodeur\CurrencyConverter\Facades\CurrencyConverter;
use Modules\Prices\Models\Inventories;
use Modules\Prices\Models\LinkPrices;
use Modules\TradeZone\Models\PriceModelsInProduct;
use Modules\TradeZone\Models\PriceTradeSettings;

class formTradePriceUseCase
{
    use Makeable;

    public function execute(Request $request)
    {
        $linksModels = LinkPrices::where('is_link', true)->get();
        foreach ($linksModels as $item) {
            PriceModelsInProduct::query()->updateOrCreate([
                'product_id'     => $item->product_id,
                'price_parse_id' => $item->price_model_id,
            ]);
        }

        $collections = LinkPrices::where([
            'is_link'  => true,
            'is_exist' => true,
        ])
            ->whereHas('priceParse.priceUploaded', function ($query) {
                $query->where('is_active', true);
            })
            ->with('priceParse.priceUploaded.currency')
            ->with('product')
            ->with('product.brand')
            ->get();

        //dd($collections);

        $setCurrency = PriceTradeSettings::with('currency')->first();

        $existingModelIds = [];
        foreach ($collections as $item) {
            $convertedAmount = CurrencyConverter::convert($item->priceParse->price)
                ->from($item->priceParse->priceUploaded->currency->code)
                ->to($setCurrency->currency->code)
                ->format();

            $dataToUpdate       = [
                'price'       => $convertedAmount,
                'rule_id'     => 1,
                'currency_id' => $setCurrency->currency_id,
                'qty'         => $item->priceParse->quantity,
            ];
            $existingModelIds[] = $item->price_model_id;
            Inventories::query()->updateOrCreate([
                'product_id'     => $item->product_id,
                'price_model_id' => $item->price_model_id,
            ], $dataToUpdate);
        }

        Inventories::whereNotIn('price_model_id', $existingModelIds)->delete();

        return back()->with('info', 'Готово!');
    }
}