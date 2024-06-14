<?php

namespace Modules\TradeZone\UseCases;

use App\Traits\Makeable;
use Illuminate\Http\Request;
use Modules\TradeZone\Models\Rules;

class editRuleTradePriceUseCase
{
    use Makeable;

    public function execute(Request $request)
    {
        $data = $request->all();
        //dd($data);

        $rulesTrade = [];
        if (isset($data['is_active'])) {
            Rules::where('id', $data['id'][0])->update(['is_active' => $data['is_active']]);
            $rulesTrade = Rules::where('id', $data['id'])->with('priceUploaded')->first();
        }
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
        if (isset($data['sort'])) {
            Rules::where('id', $data['id'])->update(['sort' => $data['sort']]);
            $rulesTrade = Rules::where('id', $data['id'])->with('priceUploaded')->first();
        }
        if (isset($data['pricesIds'])) {
            $rule =  Rules::find($data['id']);

            $rule
                ->price_uploaded()
                ->sync($data['pricesIds']);

            $rulesTrade = Rules::where('id', $data['id'])
                ->with('priceUploaded')
                ->with('price_uploaded')
                ->first();
        }
        if (isset($data['categoriesIds'])) {
            $rule =  Rules::find($data['id']);

            $rule
                ->categories()
                ->sync($data['categoriesIds']);

            $rulesTrade = Rules::where('id', $data['id'])
                ->with('priceUploaded')
                ->with('categories')
                ->first();
        }
        if (isset($data['brandsIds'])) {
            $rule =  Rules::find($data['id']);

            $rule
                ->brands()
                ->sync($data['brandsIds']);

            $rulesTrade = Rules::where('id', $data['id'])
                ->with('priceUploaded')
                ->with('brands')
                ->first();
        }
        if (isset($data['copy'])) {
            $copy = Rules::findOrFail($data['id'])->replicate()->fill(['is_active' => 0]);
            $copy->save();

            $rulesTrade = Rules::where('id', $copy->id)->with('priceUploaded')->first();
        }

        return $rulesTrade;
    }
}