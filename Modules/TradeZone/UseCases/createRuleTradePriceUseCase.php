<?php

namespace Modules\TradeZone\UseCases;

use App\Traits\Makeable;
use Illuminate\Http\Request;
use Modules\TradeZone\Models\Rules;

class createRuleTradePriceUseCase
{
    use Makeable;

    public function execute(Request $request)
    {
        $data = $request->all();

        $ruleTrade                    = new Rules();
        $ruleTrade->price_min         = $data['price_min'] === null ? 0 : $data['price_min'];
        $ruleTrade->price_max         = $data['price_max'] === null ? 0 : $data['price_min'];
        $ruleTrade->trade_margin      = $data['trade_margin'];
        $ruleTrade->save();

        flash()->success('Правило создано!');

        return redirect()->back();
    }
}