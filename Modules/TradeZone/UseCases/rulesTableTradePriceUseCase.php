<?php

namespace Modules\TradeZone\UseCases;

use App\Traits\Makeable;
use Illuminate\Http\Request;
use Modules\TradeZone\Models\Rules;

class rulesTableTradePriceUseCase
{
    use Makeable;

    public function execute(Request $request)
    {
        $data = $request->all();

        $rulesTrade = Rules::with('priceUploaded')
            ->with('price_uploaded')
            ->with('categories')
            ->with('brands')
            ->limit($data['limit'])
            ->offset($data['offset'])
            ->get();

        $count = Rules::count();

        return response()->json([
            'total'            => $count,
            'totalNotFiltered' => $count,
            'rows'             => $rulesTrade,
        ]);
    }
}