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
        //dd($request->all());
        if ($data['search'] == '') {
            $priceParse = LinkPrices::query()
                ->whereHas('priceParse', function ($query) use ($data) {
                    $query->where('price_uploaded_id', $data['id']);
                })
                //->where('is_exist', 1)
                ->with('priceParse')
                ->with('priceParse.priceUploaded.currency')
                ->with('product')
                ->with('product.brand')
                ->limit($data['limit'])
                ->offset($data['offset'])
                ->orderBy($data['sort'], $data['order'])
                ->get();

            $count = LinkPrices::query()
                ->whereHas('priceParse', function ($query) use ($data) {
                    $query->where('price_uploaded_id', $data['id']);
                })
                //->where('is_exist', 1)
                ->get()
                ->count();
        } else {
            $priceParse = LinkPrices::query()
                ->whereHas('priceParse', function ($query) use ($data) {
                    $query->where('price_uploaded_id', $data['id']);
                })
                ->where(function($query) use ($data) {
                    $query->where('price_model_name','LIKE',"%{$data['search']}%");
                })
                //->where('is_exist', 1)
                ->with('priceParse')
                ->with('priceParse.priceUploaded.currency')
                ->with('product')
                ->with('product.brand')
                ->limit($data['limit'])
                ->offset($data['offset'])
                ->orderBy($data['sort'], $data['order'])
                ->get();

            $count = LinkPrices::query()
                ->whereHas('priceParse', function ($query) use ($data) {
                    $query->where('price_uploaded_id', $data['id']);
                })
                ->where(function($query) use ($data) {
                    $query->where('price_model_name','LIKE',"%{$data['search']}%");
                })
                //->where('is_exist', 1)
                ->get()
                ->count();
        }

        return response()->json([
            'total' => $count,
            'totalNotFiltered' => $count,
            'rows' => $priceParse,
        ]);
    }
}