<?php

namespace Modules\Prices\UseCases;

use Illuminate\Http\Request;
use Modules\Prices\Models\PricesUploaded;

class IsActiveUseCase
{
    public function execute(Request $request)
    {
        $data = $request->param;

        PricesUploaded::where('id', $data['price_id'])->update([
            'is_active' => $data['checkbox'],
        ]);

        $isActive = PricesUploaded::where('id', $data['price_id'])
            ->with('seller')
            ->first();

        return $isActive;
    }
}