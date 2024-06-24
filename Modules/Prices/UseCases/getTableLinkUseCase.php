<?php

namespace Modules\Prices\UseCases;

use App\Traits\Makeable;
use Illuminate\Http\Request;
use Modules\Prices\Models\LinkPrices;

class getTableLinkUseCase
{
    use Makeable;

    public function execute(Request $request)
    {
        $data = $request->all();

        $priceParse = LinkPrices::query()
            ->whereHas('priceParse', function ($query) use ($data) {
                $query->where('price_uploaded_id', $data['id']);
            })
            ->with('priceParse')
            ->with('priceParse.priceUploaded.currency')
            ->with('product')
            ->with('product.brand')
            ->limit($data['limit'])
            ->offset($data['offset'])
            ->orderBy('is_link', 'ASC')
            ->orderBy($data['sort'], $data['order']);

        $count = LinkPrices::query()
            ->whereHas('priceParse', function ($query) use ($data) {
                $query->where('price_uploaded_id', $data['id']);
            });

        if ($data['search']) {
            $priceParse = $priceParse
                ->where(function ($query) use ($data) {
                    $query->where('price_model_name', 'LIKE', "%{$data['search']}%");
                });

            $count = $count
                ->where(function ($query) use ($data) {
                    $query->where('price_model_name', 'LIKE', "%{$data['search']}%");
                });
        }

        $priceParse = $priceParse->get();
        $count      = $count->get()->count();

        return response()->json([
            'total'            => $count,
            'totalNotFiltered' => $count,
            'rows'             => $priceParse,
        ]);
    }
}