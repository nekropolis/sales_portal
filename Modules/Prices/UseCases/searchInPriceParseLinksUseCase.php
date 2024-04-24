<?php

namespace Modules\Prices\UseCases;

use App\Traits\Makeable;
use Illuminate\Http\Request;
use Modules\Prices\Models\LinkPrices;
use Elasticsearch;

class searchInPriceParseLinksUseCase
{
    use Makeable;

    public function execute(Request $request, $id)
    {
        $price_uploaded_id = $id[0];
        $q = $request->get('q');

        //dd($q);
        $response = Elasticsearch::search([
            'index' => 'price-parse',
            "size"  => 20,
            'body'  => [
                'query' => [
                    'function_score' => [
                        'query'     => [
                            'multi_match' => [
                                'query'  => $q,
                                'fields' => ['model', 'additional'],
                            ],
                        ],
                        "min_score" => 0.7,
                    ],
                ],
            ],
        ]);

        $priceIds = array_column($response['hits']['hits'], '_id');
        //dd($priceIds);

        if (!empty($priceIds)) {
            return LinkPrices::with('priceParse')
                ->whereHas('priceParse', function ($query) use ($price_uploaded_id) {
                    $query->where('price_uploaded_id', $price_uploaded_id);
                })
                ->whereNotIn('is_exist', [0])
                ->whereIn('price_model_id', $priceIds)
                ->orderBy(\DB::raw('FIELD(id,'.implode(',', $priceIds).')'))
                ->get();
        } else {
            return redirect()->back()->with('success', 'Продукт не найден!');
        }
    }
}