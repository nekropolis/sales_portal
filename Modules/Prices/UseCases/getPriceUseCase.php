<?php

namespace Modules\Prices\UseCases;

use Modules\Prices\Models\Prices;
use Modules\Prices\Models\PricesUploaded;

class getPriceUseCase
{
    public function execute($id)
    {
        //dd($id);

        $price      = Prices::where('price_uploaded_id', $id)->paginate(15);
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

        //dd($price);

        return view('prices::price', [
            'price'          => $price,
            'price_uploaded' => $price_uploaded[0],
        ]);
    }
}