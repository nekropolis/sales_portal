<?php

namespace Modules\TradeZone\UseCases;

use App\Traits\Makeable;
use Illuminate\Http\Request;
use Modules\Catalog\Models\Rules;

class editRuleTradePriceUseCase
{
    use Makeable;

    public function execute(Request $request)
    {
        $data = $request->all();
        //dd($data);

        $rulesTrade = [];
        if (isset($data['price_min'])) {
            Rules::where('id', $data['id'])->update(['price_min' => $data['price_min']]);
            $rulesTrade = Rules::where('id', $data['id'])->with('priceUploaded')->first();
        }
        if (isset($data['price_max'])) {
            Rules::where('id', $data['id'])->update(['price_max' => $data['price_max']]);
            $rulesTrade = Rules::where('id', $data['id'])->with('priceUploaded')->first();
        }
        if (isset($data['trade_margin'])) {
            Rules::where('id', $data['id'])->update(['trade_margin' => $data['trade_margin']]);
            $rulesTrade = Rules::where('id', $data['id'])->with('priceUploaded')->first();
        }
        if (isset($data['copy'])) {
            $copy = Rules::findOrFail($data['id'])->replicate()->fill(['is_active' => 0]);
            $copy->save();

            $rulesTrade = Rules::where('id', $copy->id)->with('priceUploaded')->first();
        }

        return $rulesTrade;
    }
}