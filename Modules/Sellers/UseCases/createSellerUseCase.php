<?php

namespace Modules\Sellers\UseCases;

use Modules\Sellers\Http\Requests\CreateSellerRequest;
use Modules\Sellers\Models\Sellers;

class createSellerUseCase
{
    public function execute(CreateSellerRequest $request)
    {
        $seller = new Sellers();

        $seller->name = $request->name;
        $seller->save();

        return back()->with('success', 'Поставщик создан!');
    }
}