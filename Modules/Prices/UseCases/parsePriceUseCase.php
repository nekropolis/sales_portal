<?php

namespace Modules\Prices\UseCases;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Modules\Catalog\Models\Products;
use Modules\Prices\Models\LinkPrices;
use Modules\Prices\Models\PriceParse;
use Modules\Prices\Models\PricesUploaded;
use Shuchkin\SimpleXLSX;
use Elasticsearch;

class parsePriceUseCase
{
    public function execute(Request $request)
    {
        $data = $request->all();

        $id                 = $data['price_id'];
        $orig_name          = PricesUploaded::where("id", $data['price_id'])->value("orig_name");
        $model_name         = PricesUploaded::where("id", $data['price_id'])->value("model_name");
        $price_name         = PricesUploaded::where("id", $data['price_id'])->value("price_name");
        $qty_name           = PricesUploaded::where("id", $data['price_id'])->value("qty_name");
        $additional         = PricesUploaded::where("id", $data['price_id'])->value("additional");
        $numeration_started = PricesUploaded::where("id", $data['price_id'])->value("numeration_started");
        $dataFile           = Storage::disk('local')->get('public/uploads/'.$orig_name);

        $xlsx = SimpleXLSX::parseData($dataFile);

        //dd($xlsx && $xlsx->rows() !== []);

        $header_values = $rows = [];
        if ($xlsx && $xlsx->rows() !== []) {
            $validate_model_name = false;
            $validate_price_name = false;
            $validate_qty_name   = false;
            $validate_additional = false;

            $nameRow =[];
            foreach (array_slice($xlsx->rows(), $numeration_started - 1) as $k => $r) {
                if ($k === 0) {
                    $nameRow = $r;

                    if ($model_name && in_array($model_name, $r)) {
                        $validate_model_name = true;
                    }
                    if ($price_name && in_array($price_name, $r)) {
                        $validate_price_name = true;
                    }
                    if ($qty_name && in_array($qty_name, $r)) {
                        $validate_qty_name = true;
                    }
                    if ($additional && in_array($additional, $r)) {
                        $validate_additional = true;
                    }
                }
            }

            $valid = !$validate_model_name ? 'Наименование'.'-('.implode(",", $nameRow).')'
                : (!$validate_price_name ? 'Цена'.'-('.implode(",", $nameRow).')'
                    : (!$validate_qty_name ? 'Колличество'.'-('.implode(",", $nameRow).')'
                        : (!$validate_additional ? 'Любое название колонки'.'-('.implode(",", $nameRow).')'
                            : 'ok')));

            if ($valid == 'ok') {
                foreach (array_slice($xlsx->rows(), $numeration_started - 1) as $k => $r) {
                    if ($k === 0) {
                        $header_values = $r;
                        continue;
                    }
                    $rows[] = array_combine($header_values, $r);
                }
            } else {
                return back()->with('error',
                    'Ошибка, проверьте правильность поля - "'.$valid.'". Или номер строки, где размещено наименование');
            }
        } else {
            return back()->with('error',
                'Ошибка, не верный формат прайс-листа, попробуйте пересохранить в другом формате.');
        }

        $existingNamesRows = [];
        foreach ($rows as $item) {
            $existingNamesRows[] = $item[$model_name];
            PriceParse::query()->updateOrCreate([
                'model'             => $item[$model_name],
                'price_uploaded_id' => $id,
            ],
                [
                    'price'      => $item[$price_name],
                    'quantity'   => $item[$qty_name],
                    'additional' => $item[$additional],
                ]);
        }

        PriceParse::where(['price_uploaded_id' => $id])->whereNotIn('model',
            $existingNamesRows)->update(['quantity' => 0]);

        $prices = PriceParse::with('link')->where(['price_uploaded_id' => $id])->whereNotIn('quantity', [0])->get();

        $existingNames = [];
        foreach ($prices as $price) {
            $response = Elasticsearch::search([
                'index' => 'products',
                'body'  => [
                    'query' => [
                        'function_score' => [
                            'query'     => [
                                'multi_match' => [
                                    'query'  => $price->model,
                                    'fields' => ['brand', 'model'],
                                ],
                            ],
                            "min_score" => 0.7,
                        ],
                    ],
                ],
            ]);

            $productIds = array_column($response['hits']['hits'], '_id');

            if (!empty($productIds)) {
                $productId = Products::whereIn('id', $productIds)
                    ->orderBy(\DB::raw('FIELD(id,'.implode(',', $productIds).')'))
                    ->first()->id;
            } else {
                $productId = 0;
            }

            $dataToUpdate = [
                'is_link'    => 0,
                'product_id' => $productId,
                'is_exist'   => 1,
            ];

            if ($price->link !== null && $price->link->is_link === 0) {
                $dataToUpdate['is_link']    = $price->link->is_link;
                $dataToUpdate['product_id'] = $productId;
                $dataToUpdate['is_exist']   = 1;
            } elseif ($price->link !== null && $price->link->is_link === 1) {
                $dataToUpdate['is_link']    = $price->link->is_link;
                $dataToUpdate['product_id'] = $price->link->product_id;
                $dataToUpdate['is_exist']   = 1;
            }

            $existingNames[] = $price->model;
            LinkPrices::query()->updateOrCreate([
                'price_model_id'       => $price->id,
                'price_model_name_md5' => md5($price->model),
                'price_model_name'     => $price->model,
            ], $dataToUpdate);
        }

        LinkPrices::with('priceParse')
            ->whereHas('priceParse', function ($query) use ($id) {
                $query->where('price_uploaded_id', $id);
            })
            ->whereNotIn('price_model_name', $existingNames)
            ->update(['is_exist' => 0]);

        return back()->with('success', 'Готово!');
    }
}