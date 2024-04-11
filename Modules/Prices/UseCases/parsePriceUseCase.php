<?php

namespace Modules\Prices\UseCases;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Modules\Prices\Entities\Prices;
use Modules\Prices\Entities\PricesUploaded;
use Shuchkin\SimpleXLSX;

class parsePriceUseCase
{
    public function execute(Request $request)
    {
        $data = $request->all();

        //dd($data['price_id']);

        $id                 = $data['price_id'];
        $orig_name          = PricesUploaded::where("id", $data['price_id'])->value("orig_name");
        $model_name         = PricesUploaded::where("id", $data['price_id'])->value("model_name");
        $price_name         = PricesUploaded::where("id", $data['price_id'])->value("price_name");
        $qty_name           = PricesUploaded::where("id", $data['price_id'])->value("qty_name");
        $additional         = PricesUploaded::where("id", $data['price_id'])->value("additional");
        $numeration_started = PricesUploaded::where("id", $data['price_id'])->value("numeration_started");
        $data               = Storage::disk('local')->get('public/uploads/'.$orig_name);


        $xlsx = SimpleXLSX::parseData($data);

        //print_r( $xlsx->rows() );

        $header_values = $rows = [];
        if ($xlsx->success()) {
            $validate_model_name = false;
            $validate_price_name = false;
            $validate_qty_name   = false;
            $validate_additional = false;

            foreach (array_slice($xlsx->rows(), $numeration_started - 1) as $r) {
                if (in_array($model_name, $r)) {
                    $validate_model_name = true;
                }
                if (in_array($price_name, $r)) {
                    $validate_price_name = true;
                }
                if (in_array($qty_name, $r)) {
                    $validate_qty_name = true;
                }
                if (in_array($additional, $r)) {
                    $validate_additional = true;
                }
            }

            if ($validate_model_name && $validate_price_name && $validate_qty_name && $validate_additional) {
                foreach (array_slice($xlsx->rows(), $numeration_started - 1) as $k => $r) {
                    if ($k === 0) {
                        $header_values = $r;
                        continue;
                    }
                    $rows[] = array_combine($header_values, $r);
                }
            }
        }

        $existingNames = [];

        foreach ($rows as $item) {
            //dd($rows, $item);
            $existingNames[] = $item[$model_name];
            Prices::query()->updateOrCreate([
                'model'             => $item[$model_name],
                'price_uploaded_id' => $id,
            ],
                [
                    'price'      => $item[$price_name],
                    'quantity'   => $item[$qty_name],
                    'additional' => $item[$additional],
                ]);
        }

        Prices::where(['price_uploaded_id' => $id])->whereNotIn('model', $existingNames)->update(['quantity' => 0]);
    }
}