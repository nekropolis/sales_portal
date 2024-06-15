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
        //dd($data);

        $ruleTrade                    = new Rules();
        $ruleTrade->price_min         = $data['price_min'];
        $ruleTrade->price_max         = $data['price_max'];
        //$ruleTrade->price_uploaded_id = $data['price_id'];
        //$ruleTrade->category_id       = $data['category_id'];
        //$ruleTrade->brand_id          = $data['brand_id'];
        $ruleTrade->trade_margin      = $data['trade_margin'];
        $ruleTrade->save();

        return redirect()->back()->with('success', 'Правило создано!');
    }
}