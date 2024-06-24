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
        $data       = $request->all();
        $rulesTrade = Rules::find($data['id']);

        if (isset($data['is_active'])) {
            $rulesTrade->is_active = $data['is_active'];
            $rulesTrade->update();
        }
        if (isset($data['price_min'])) {
            $rulesTrade->price_min = $data['price_min'];
            $rulesTrade->update();
        }
        if (isset($data['price_max'])) {
            $rulesTrade->price_max = $data['price_max'];
            $rulesTrade->update();
        }
        if (isset($data['trade_margin'])) {
            if (!preg_match("#^[\d./%]+$#", $data['trade_margin'])) {

                return response()->json([
                    'type'    => 'error',
                    'message' => 'Только число или число%',
                ]);
            }

            $rulesTrade->trade_margin = $data['trade_margin'];
            $rulesTrade->update();
        }
        if (isset($data['sort'])) {
            $rulesTrade->sort = $data['sort'];
            $rulesTrade->update();
        }

        if (isset($data['pricesIds'])) {
            $rulesTrade
                ->price_uploaded()
                ->sync($data['pricesIds']);
        }
        if (isset($data['categoriesIds'])) {
            $rulesTrade
                ->categories()
                ->sync($data['categoriesIds']);
        }
        if (isset($data['brandsIds'])) {
            $rulesTrade
                ->brands()
                ->sync($data['brandsIds']);
        }
        if (isset($data['copy'])) {
            $copy = $rulesTrade->replicate()->fill(['is_active' => 0]);
            $copy->save();

            return response()->json([
                'type'       => 'success',
                'message'    => 'Правило скопировано!',
            ]);
        }

        $rulesTrade = $rulesTrade
            ->where('id', $data['id'])
            ->with('priceUploaded')
            ->with('price_uploaded')
            ->with('categories')
            ->with('brands')
            ->get();

        return response()->json([
            'type'       => 'success',
            'message'    => 'Запись обновлена',
            'rulesTrade' => $rulesTrade,
        ]);
    }
}