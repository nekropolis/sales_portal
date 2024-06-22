<?php

namespace Modules\Sellers\UseCases;

use Modules\Sellers\Http\Requests\CreateSellerRequest;
use Modules\Sellers\Models\Sellers;

class addSellerUseCase
{
    public function execute(CreateSellerRequest $request)
    {
        $seller = new Sellers();

        $seller->name = $request->name;
        $seller->save();

        flash()->success('Поставщик создан!');

        return redirect()->back();
    }
}