<?php

namespace Modules\Prices\UseCases;

use Modules\Currency\Models\Currency;
use Modules\Prices\Models\PricesUploaded;
use Modules\Sellers\Models\Sellers;

class getUploadedPricesUseCase
{
    public function execute()
    {
        $collection = PricesUploaded::query()
            ->with('seller')
            ->get();

        $result = $collection->map(function ($room) {
            $data                 = $room->makeHidden('seller')->toArray();
            $data ['seller_name'] = $room->seller->name;

            return $data;
        });

        $sellers    = Sellers::all();
        $currencies = Currency::all();

        return view('prices::upload-prices', [
            'prices'     => $result,
            'sellers'    => $sellers,
            'currencies' => $currencies,
        ]);
    }
}