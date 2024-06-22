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

        $products               = new Products();
        $products->sku          = $data['sku'];
        $products->brand_id     = $data['brand'];
        $products->category_id  = $data['category'];
        $products->model        = $data['model'];
        $products->localization = $data['localization'];
        $products->package      = $data['package'];
        $products->condition    = $data['condition'];
        $products->save();

        flash()->success('Продукт добавлен!');

        return redirect()->back();
    }
}