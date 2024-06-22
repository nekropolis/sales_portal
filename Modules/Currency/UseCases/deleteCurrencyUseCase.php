<?php

namespace Modules\Currency\UseCases;

use App\Traits\Makeable;
use Illuminate\Http\Request;
use Modules\Currency\Models\Currency;
use Modules\Prices\Models\PricesUploaded;
use Modules\TradeZone\Models\PriceTradeSettings;

class deleteCurrencyUseCase
{
    use Makeable;

    public function execute(Request $request)
    {
        $data = $request->all();

        $currency                = Currency::findOrFail($data['currency_id']);
        $checkCurrencyInSettings = PriceTradeSettings::where('currency_id', $data['currency_id'])->get()->count();
        $checkCurrencyInPrice    = PricesUploaded::where('currency_id', $data['currency_id'])->get()->count();

        if ($checkCurrencyInSettings && $checkCurrencyInPrice) {
            return response()->json([
                'type'    => 'error',
                'message' => 'Валюта используется, нельзя удлить.',
            ]);
        }

        $currency->delete();

        return response()->json([
            'type'    => 'success',
            'message' => 'Валюта удалена!',
        ]);
    }
}