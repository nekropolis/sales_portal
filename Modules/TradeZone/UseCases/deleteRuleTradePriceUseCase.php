<?php

namespace Modules\TradeZone\UseCases;

use App\Traits\Makeable;
use Illuminate\Http\Request;
use Modules\TradeZone\Models\Rules;

class deleteRuleTradePriceUseCase
{
    use Makeable;

    public function execute(Request $request)
    {
        $data = $request->all();
        //dd($data);

        Rules::where('id', $data['rule_id'])->delete();

        return response()->json(["success" => "Правило удалено!"]);
    }
}