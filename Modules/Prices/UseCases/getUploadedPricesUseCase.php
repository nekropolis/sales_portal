<?php

namespace Modules\Prices\UseCases;

use App\Models\Sellers;
use Modules\Prices\Models\PricesUploaded;

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

        $sellers = Sellers::all();

        return view('prices::upload_prices', [
            'prices'  => $result,
            'sellers' => $sellers,
        ]);
    }
}