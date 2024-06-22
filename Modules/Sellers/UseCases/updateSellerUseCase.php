<?php

namespace Modules\Sellers\UseCases;

use Modules\Sellers\Http\Requests\UpdateSellerRequest;
use Modules\Sellers\Models\Sellers;

class updateSellerUseCase
{
    public function execute(UpdateSellerRequest $request)
    {
        $data    = $request->all();
        $seller  = Sellers::findOrFail($data['seller_id']);
        $message = '';

        if (!$seller) {
            throw new \Exception('Not found');
        }

        if (isset($data['name'])) {
            $seller->name = $data['name'];
            $seller->update();

            $message = 'Поставщик обновлен!';
        }

        $seller->get()->toArray();


        return response()->json([
            'type'    => 'success',
            'message' => $message,
            'seller'  => $seller,
        ]);
    }
}