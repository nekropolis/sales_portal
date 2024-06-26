<?php

namespace Modules\TradeZone\UseCases;

use App\Traits\Makeable;
use Illuminate\Http\Request;
use Modules\TradeZone\Models\PriceTradeSettings;

class setCurrencyTradePriceUseCase
{
    use Makeable;

    public function execute(Request $request)
    {
        $data = $request->all();

        $tradeSettings = PriceTradeSettings::where('id', 1);
        $tradeSettings->update(['currency_id' => $data['id']]);

        return response()->json([
            'type'    => 'success',
            'message' => 'Валюта задана!',
        ]);
    }
}