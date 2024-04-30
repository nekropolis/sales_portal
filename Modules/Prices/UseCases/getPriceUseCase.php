<?php

namespace Modules\Prices\UseCases;


use App\Traits\Makeable;
use Illuminate\Http\Request;
use Modules\Catalog\Models\Products;
use Modules\Prices\Models\PricesUploaded;

class getPriceUseCase
{
    use Makeable;

    public function execute(Request $request, $id)
    {

        if ($request->get('q')) {
            $price = searchInPriceParseLinksUseCase::make()->execute($request, [$id]);
        } else {
            $price = formPriceUseCase::make()->execute($request, [$id]);
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

        $products = Products::all();

        return view('prices::price-parse-links', [
            'price'          => $price,
            'products'       => $products,
            'price_uploaded' => $price_uploaded[0],
            'showPagination' => is_null($request->get('q')),
        ]);
    }
}