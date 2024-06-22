<?php

namespace Modules\Currency\UseCases;

use App\Traits\Makeable;
use Doctrine\Inflector\Rules\French\Rules;
use Illuminate\Http\Request;
use Modules\Categories\Models\Categories;
use Modules\Currency\Models\Currency;
use Modules\Prices\Models\PricesUploaded;
use Modules\Products\Models\Products;
use Modules\TradeZone\Models\PriceTradeSettings;

class deleteCurrencyUseCase
{
    use Makeable;

    public function execute(Request $request)
    {
        $data = $request->all();

        $category                = Currency::findOrFail($data['currency_id']);
        $checkCurrencyInSettings = PriceTradeSettings::where('category_id', $data['category_id'])->get()->count();
        $checkCurrencyInPrice    = PricesUploaded::where('category_id', $data['category_id'])->get()->count();

        if ($checkCurrencyInSettings && $checkCurrencyInPrice) {
            return response()->json([
                'type'    => 'error',
                'message' => 'Валюта используется, нельзя удлить.',
            ]);
        }

        $category->delete();

        return response()->json([
            'type'    => 'success',
            'message' => 'Валюта удалена!',
        ]);
    }
}