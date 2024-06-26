<?php

namespace Modules\Prices\UseCases;


use App\Traits\Makeable;
use Illuminate\Http\Request;
use Modules\Currency\Models\Currency;
use Modules\Prices\Models\PricesUploaded;
use Modules\Products\Models\Products;

class getPriceParseUseCase
{
    use Makeable;

    public function execute(Request $request, $id)
    {
        $collection = PricesUploaded::where('id', $id)
            ->with('seller')
            ->with('currency')
            ->get();

        $price_uploaded = $collection->map(function ($price_upload) {
            $data['id']              = $price_upload['id'];
            $data['price_name']      = $price_upload['name'];
            $data['orig_price_name'] = $price_upload['orig_name'];
            $data['status']          = $price_upload['status'];
            $data['seller_name']     = $price_upload->seller->name;
            $data['currency']        = $price_upload->currency ? $price_upload->currency->code : '';

            return $data;
        });

        $products   = Products::all();
        $currencies = Currency::all();

        return view('prices::price-parse-links', [
            'products'       => $products,
            'currencies'     => $currencies,
            'price_uploaded' => $price_uploaded[0],
            'showPagination' => is_null($request->get('q')),
        ]);
    }
}