<?php

namespace Modules\Currency\UseCases;

use App\Traits\Makeable;
use Illuminate\Http\Request;
use Modules\Currency\Models\Currency;

class addCurrencyUseCase
{
    use Makeable;

    public function execute(Request $request)
    {
        $data = $request->all();

        $currency       = new Currency();
        $currency->name = $data['name'];
        $currency->code = $data['code'];
        $currency->save();

        flash()->success('Валюта добавлена!');

        return redirect()->back();
    }
}