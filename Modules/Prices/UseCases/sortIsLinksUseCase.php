<?php

namespace Modules\Prices\UseCases;

use App\Traits\Makeable;
use Illuminate\Http\Request;
use Modules\Prices\Models\LinkPrices;

class sortIsLinksUseCase
{
    use Makeable;

    public function execute(Request $request, $id)
    {
        $price_uploaded_id = $id[0];

        return LinkPrices::query()
            ->whereHas('priceParse', function ($query) use ($price_uploaded_id) {
                $query->where('price_uploaded_id', $price_uploaded_id);
            })
            ->where('is_exist', 1)
            ->with('priceParse')
            ->with('product')
            ->with('product.brand')
            ->orderBy('is_link', 'ASC')
            ->paginate(20);
    }
}