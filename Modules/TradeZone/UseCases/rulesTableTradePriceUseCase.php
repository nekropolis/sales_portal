<?php

namespace Modules\TradeZone\UseCases;

use App\Traits\Makeable;
use Illuminate\Http\Request;
use Modules\Catalog\Models\Rules;

class rulesTableTradePriceUseCase
{
    use Makeable;

    public function execute(Request $request)
    {
        $data = $request->all();
        //dd($data);

        $rulesTrade = Rules::with('priceUploaded')
            ->limit($data['limit'])
            ->offset($data['offset'])
            ->get();

        $count = Rules::all()->count();

        //dd($rulesTrade);

        return response()->json([
            'total'            => $count,
            'totalNotFiltered' => $count,
            'rows'             => $rulesTrade,
        ]);
    }
}