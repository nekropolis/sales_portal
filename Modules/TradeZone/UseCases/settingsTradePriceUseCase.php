<?php

namespace Modules\TradeZone\UseCases;


use App\Traits\Makeable;
use Illuminate\Http\Request;
use Mgcodeur\CurrencyConverter\Facades\CurrencyConverter;
use Modules\Catalog\Models\Brands;
use Modules\Catalog\Models\Categories;
use Modules\Catalog\Models\Currency;
use Modules\Prices\Models\Inventories;
use Modules\Prices\Models\LinkPrices;
use Modules\Prices\Models\PricesUploaded;
use Modules\Sellers\Models\Sellers;
use Modules\TradeZone\Models\PriceTradeSettings;

class settingsTradePriceUseCase
{
    use Makeable;

    public function execute(Request $request)
    {
        $currencies    = Currency::all();
        $sellers       = PricesUploaded::with('seller')->with('currency')->get();
        $categories    = Categories::all();
        $brands        = Brands::all();
        $tradeSettings = PriceTradeSettings::with('currency')->first();

        return view('tradezone::price-trade-settings', [
            'currencies'    => $currencies,
            'sellers'       => $sellers,
            'categories'    => $categories,
            'brands'        => $brands,
            'tradeSettings' => $tradeSettings,
        ]);
    }
}