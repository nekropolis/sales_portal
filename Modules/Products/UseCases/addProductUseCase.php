<?php

namespace Modules\Products\UseCases;

use App\Traits\Makeable;
use Illuminate\Http\Request;
use Modules\Products\Models\Products;

class addProductUseCase
{
    use Makeable;

    public function execute(Request $request)
    {
        $data = $request->all();

        $products                  = new Products();
        $products->sku             = $data['sku'];
        $products->brand_id        = $data['brand_id'];
        $products->category_id     = $data['category_id'];
        $products->model           = $data['model'];
        $products->localization_id = $data['localization_id'];
        $products->package         = $data['package'];
        $products->condition       = $data['condition'];
        $products->save();

        flash()->success('Продукт добавлен!');

        return redirect()->back();
    }
}