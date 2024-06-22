<?php

namespace Modules\Sellers\UseCases;

use Illuminate\Http\Request;
use Modules\Prices\Models\PricesUploaded;
use Modules\Sellers\Models\Sellers;

class deleteSellerUseCase
{
    public function execute(Request $request)
    {
        $data = $request->all();

        $is_prices_exist = PricesUploaded::where('seller_id', $data['seller_id'])->first();

        if ($is_prices_exist) {
            return response()->json([
                'type'    => 'error',
                'message' => 'Нельзя удалить, есть загруженные прайс-листы!',
            ]);
        }
        $seller = Sellers::findOrFail($data['seller_id']);
        $seller->delete();

        return response()->json([
            'type'    => 'success',
            'message' => 'Поставщик удален!',
        ]);
    }
}