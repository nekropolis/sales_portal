<?php

namespace Modules\TradeZone\UseCases;


use App\Traits\Makeable;
use Illuminate\Http\Request;
use Modules\Catalog\Models\Currency;

class getTradePriceUseCase
{
    use Makeable;

    public function execute(Request $request)
    {
        $currencies = Currency::all();

        return view('tradezone::price-trade', [
            'currencies' => $currencies,
        ]);
    }
}