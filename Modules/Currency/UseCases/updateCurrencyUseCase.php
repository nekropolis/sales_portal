<?php

namespace Modules\Currency\UseCases;

use App\Traits\Makeable;
use Illuminate\Http\Request;
use Modules\Currency\Models\Currency;

class updateCurrencyUseCase
{
    use Makeable;

    public function execute(Request $request)
    {
        $data     = $request->all();
        $currency = Currency::findOrFail($data['currency_id']);
        $message  = '';

        if (!$currency) {
            throw new \Exception('Not found');
        }

        if (isset($data['name'])) {
            $currency->name = $data['name'];
            $currency->code = $data['code'];
            $currency->update();

            $message = 'Валюта обновлена!';
        }

        $currency->get()->toArray();


        return response()->json([
            'type'     => 'success',
            'message'  => $message,
            'currency' => $currency,
        ]);
    }
}