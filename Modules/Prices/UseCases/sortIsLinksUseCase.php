<?php

namespace Modules\Prices\UseCases;

use App\Traits\Makeable;
use Illuminate\Http\Request;
use Modules\Prices\Models\LinkPrices;

class sortIsLinksUseCase
{
    use Makeable;

    public function execute(Request $request)
    {
        $sort_link = $request->get('is_link_sort');
        $id = $request->get('price_upload_id');

        return LinkPrices::query()
            ->whereHas('priceParse', function ($query) use ($id) {
                $query->where('price_uploaded_id', $id);
            })
            ->where('is_exist', 1)
            ->with('priceParse')
            ->with('product')
            ->with('product.brand')
            ->orderBy('is_link', 'ASC')
            ->paginate(20);
    }
}