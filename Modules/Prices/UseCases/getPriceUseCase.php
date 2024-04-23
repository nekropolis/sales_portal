<?php

namespace Modules\Prices\UseCases;


use Illuminate\Http\Request;
use Modules\Prices\Models\LinkPrices;
use Modules\Prices\Models\Prices;
use Modules\Prices\Models\PricesUploaded;
use Elasticsearch;

class getPriceUseCase
{
    public function execute(Request $request, $id)
    {
        $q = $request->get('q');

        if ($q) {
            $response = Elasticsearch::search([
                'index' => 'price-links',
                "size"  => 20,
                'body'  => [
                    'query' => [
                        'function_score' => [
                            'query'     => [
                                'multi_match' => [
                                    'query'  => $q,
                                    'fields' => ['price_model_name', 'price_model_name_md5'],
                                ],
                            ],
                            "min_score" => 0.7,
                        ],
                    ],
                ],
            ]);

            $priceIds = array_column($response['hits']['hits'], '_id');
            $price    = LinkPrices::with('price')
                ->whereHas('price', function ($query) use ($id) {
                    $query->where('price_uploaded_id', $id);
                })
                ->whereNotIn('is_exist', [0])
                ->whereIn('id', $priceIds)
                ->orderBy(\DB::raw('FIELD(id,'.implode(',', $priceIds).')'))
                ->get();
        } else {
            $price = LinkPrices::query()
                ->whereHas('price', function ($query) use ($id) {
                    $query->where('price_uploaded_id', $id);
                })
                ->where('is_exist', 1)
                ->with('price')
                ->with('product')
                ->with('product.brand')
                ->paginate(20);
        }

        $collection = PricesUploaded::where('id', $id)
            ->with('seller')
            ->get();

        $price_uploaded = $collection->map(function ($price_upload) {
            $data['id']              = $price_upload['id'];
            $data['price_name']      = $price_upload['name'];
            $data['orig_price_name'] = $price_upload['orig_name'];
            $data['status']          = $price_upload['status'];
            $data['seller_name']     = $price_upload->seller->name;

            return $data;
        });

        return view('prices::price', [
            'price'          => $price,
            'price_uploaded' => $price_uploaded[0],
            'showPagination' => is_null($q),
        ]);
    }
}