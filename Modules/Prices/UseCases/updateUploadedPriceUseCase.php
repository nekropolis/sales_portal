<?php

namespace Modules\Prices\UseCases;

use Illuminate\Http\Request;
use Modules\Prices\Models\PricesUploaded;

class updateUploadedPriceUseCase
{
    public function execute(Request $request)
    {
        $data = $request->all();

        //dd($data);

        $price = PricesUploaded::with('currency')->find($data['price_id']);
        if (!$price) {
            throw new \Exception('Not found');
        }

        if (isset($data['name'])) {
            $price->name               = $data['name'];
            $price->sheet_name         = $data['sheet_name'];
            $price->numeration_started = $data['numeration_started'];
            $price->model_name         = $data['model_name'];
            $price->price_name         = $data['price_name'];
            $price->qty_name           = $data['qty_name'];
            $price->additional         = $data['additional'];
            $price->currency_id        = $data['currency_id'];
            $price->save();

            return redirect()->back()->with('success', 'Настройки обновлены!');
        } else {
            $price->get()->toArray();

            return $price;
        }
    }
}