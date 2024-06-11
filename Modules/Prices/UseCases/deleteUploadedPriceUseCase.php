<?php

namespace Modules\Prices\UseCases;

use Illuminate\Http\Request;
use Modules\Prices\Models\PriceParse;
use Modules\Prices\Models\PricesUploaded;


class deleteUploadedPriceUseCase
{
    public function execute(Request $request)
    {
        $data = $request->all();

        PriceParse::where('price_uploaded_id', $data['price_id'])->delete();
        PricesUploaded::where('id', $data['price_id'])->delete();

        return redirect()->back()->with('success', 'Прайс удален!');
    }
}