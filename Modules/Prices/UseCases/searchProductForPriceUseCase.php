<?php

namespace Modules\Prices\UseCases;


use Illuminate\Http\Request;
use Modules\Catalog\Models\Products;
use Elasticsearch;

class searchProductForPriceUseCase
{
    public function execute(Request $request)
    {
        $q = $request->get('q');

        //dd($q);
        $response = Elasticsearch::search([
            'index' => 'products',
            "size"  => 15,
            'body'  => [
                'query' => [
                    'function_score' => [
                        'query'     => [
                            'multi_match' => [
                                'query'  => $q,
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
            return Products::with('brand')->whereIn('id', $productIds)
                ->orderBy(\DB::raw('FIELD(id,'.implode(',', $productIds).')'))->get();
        } else {
            return array(['model' => 'Совпадений не найдено!']);
        }
    }
}