<?php

namespace Modules\Prices\UseCases;


use App\Traits\Makeable;
use Illuminate\Http\Request;
use Modules\Prices\Models\PricesUploaded;

class getPriceParseUseCase
{
    use Makeable;

    public function execute(Request $request, $id)
    {
        $sort_link = $request->get('is_link_sort');

        if ($request->get('q')) {
            $price = searchInPriceParseLinksUseCase::make()->execute($request, [$id]);
        } elseif ($sort_link == 1) {
            $price = sortIsLinksUseCase::make()->execute($request, [$id]);
        } else {
            $price = listLinksUseCase::make()->execute($request, [$id]);
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

        return view('prices::price-parse-links', [
            'price'          => $price,
            'price_uploaded' => $price_uploaded[0],
            'showPagination' => is_null($request->get('q')),
        ]);
    }
}