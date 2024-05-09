<?php

namespace Modules\Prices\UseCases;

use Illuminate\Http\Request;
use Modules\Prices\Models\PricesUploaded;

class IsActiveUseCase
{
    public function execute(Request $request)
    {
        $data = $request->param;

        return PricesUploaded::where('id', $data['price_id'])->update([
            'is_active' => $data['checkbox'],
        ]);
    }
}