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

            return redirect()->back()->with('error', 'Нельзя удалить, есть загруженные прайс-листы!');
        } else {
            $seller = Sellers::findOrFail($data['seller_id']);
            $seller->delete();

            return redirect()->back()->with('success', 'Поставщик удален!');
        }
    }
}