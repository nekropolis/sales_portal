<?php

namespace Modules\Prices\UseCases;

use App\Traits\Makeable;
use Illuminate\Http\Request;
use Modules\Prices\Models\LinkPrices;
use Modules\Prices\Models\PricesUploaded;

class getTableUploadPriceUseCase
{
    use Makeable;

    public function execute(Request $request)
    {
        $data = $request->all();

        $pricesUploaded = PricesUploaded::query()
            ->with('seller')
            ->limit($data['limit'])
            ->offset($data['offset'])
            ->get();

        $count = PricesUploaded::all()->count();

        return response()->json([
            'total' => $count,
            'totalNotFiltered' => $count,
            'rows' => $pricesUploaded,
        ]);

    }
}