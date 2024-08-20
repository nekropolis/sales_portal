<?php

namespace Modules\Prices\UseCases;

use Illuminate\Http\Request;
use Modules\Prices\Models\Elastic;
use Modules\Products\Models\Products;

class searchProductForPriceUseCase
{
    public function execute(Request $request, Elastic $elasticHelper)
    {
        $productIds = $elasticHelper->getProductIds($request->get('q'));

        if (!empty($productIds)) {
            return Products::with('brand')->whereIn('id', $productIds)
                ->orderBy(\DB::raw('FIELD(id,'.implode(',', $productIds).')'))->get();
        } else {
            return [['model' => 'Совпадений не найдено!']];
        }
    }
}