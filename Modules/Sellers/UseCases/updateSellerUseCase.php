<?php

namespace Modules\Sellers\UseCases;

use Modules\Sellers\Http\Requests\UpdateSellerRequest;
use Modules\Sellers\Models\Sellers;

class updateSellerUseCase
{
    public function execute(UpdateSellerRequest $request)
    {
        $data = $request->all();

        $seller = Sellers::find($data['seller_id']);
        if (!$seller) {
            throw new \Exception('Не найден!');
        }

        if (isset($data['name'])) {
            $seller->name = $data['name'];
            $seller->save();

            return Sellers::where('id', $data['seller_id'])->first();
        } else {
            $seller->get()->toArray();

            return $seller;
        }
    }
}