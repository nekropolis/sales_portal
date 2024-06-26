<?php

namespace Modules\Prices\UseCases;

use Modules\Prices\Http\Requests\UpdateUploadPriceRequest;
use Modules\Prices\Models\PricesUploaded;

class updateUploadedPriceUseCase
{
    public function execute(UpdateUploadPriceRequest $request)
    {
        $data = $request->all();

        $price = PricesUploaded::with('currency')->find($data['price_id']);
        if (!$price) {
            throw new \Exception('Not found');
        }

        if (isset($data['name'])) {
            $price->name               = $data['name'];
            $price->sheet_name         = $data['sheet_name'];
            $price->numeration_started = $data['numeration_started'] ?? 1;
            $price->model_name         = $data['model_name'];
            $price->price_name         = $data['price_name'];
            $price->qty_name           = $data['qty_name'];
            $price->additional         = $data['additional'];
            $price->currency_id        = $data['currency_id'] ?? 0;
            $price->save();

            flash()->success('Настройки обновлены!');

            return redirect()->back();
        } else {
            $price->get()->toArray();

            return $price;
        }
    }
}