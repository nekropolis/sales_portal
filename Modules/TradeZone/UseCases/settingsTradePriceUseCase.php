<?php

namespace Modules\TradeZone\UseCases;


use App\Traits\Makeable;
use Illuminate\Http\Request;
use Modules\Brands\Models\Brands;
use Modules\Categories\Models\Categories;
use Modules\Currency\Models\Currency;
use Modules\Prices\Models\PricesUploaded;
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