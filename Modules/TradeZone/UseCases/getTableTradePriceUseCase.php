<?php

namespace Modules\TradeZone\UseCases;


use App\Traits\Makeable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Modules\Prices\Models\Inventories;

class getTableTradePriceUseCase
{
    use Makeable;

    public function execute(Request $request)
    {
        $data = $request->all();
        //dd($request->all());
        $sameModel = Inventories::selectRaw('product_id, min(price) as price')
            ->groupBy('product_id');

        //
        //dd($sameModel->get()->count());

        if ($data['search'] == null) {
            $priceTrade = Inventories::join(DB::raw('('.$sameModel->toSql().') as sub'), function ($join) {
                $join->on('sub.price', '=', 'inventories.price');
                $join->on('sub.product_id', '=', 'inventories.product_id');
            })
                ->with('priceParse')
                ->with('product')
                ->with('currency')
                ->with('product.brand')
                ->with('product.category')
                ->limit($data['limit'])
                ->offset($data['offset'])
                ->get(['inventories.*']);

            $count = $sameModel->get()->count();
        } else {
            $priceTrade = Inventories::join(DB::raw('('.$sameModel->toSql().') as sub'), function ($join) {
                $join->on('sub.price', '=', 'inventories.price');
                $join->on('sub.product_id', '=', 'inventories.product_id');
            })
                ->with('priceParse')
                ->with('product')
                ->whereHas('product', function ($query) use ($data) {
                    $query->where('model', 'LIKE', "%{$data['search']}%");
                })
                ->with('currency')
                ->with('product.brand')
                ->with('product.category')
                ->limit($data['limit'])
                ->offset($data['offset'])
                ->get(['inventories.*']);

            $count = Inventories::whereHas('product', function ($query) use ($data) {
                    $query->where('model', 'LIKE', "%{$data['search']}%");
                })
                    ->selectRaw('product_id, min(price) as price')
                    ->groupBy('product_id')
                    ->get()
                    ->count();
        }

        return response()->json([
            'total'            => $count,
            'totalNotFiltered' => $count,
            'rows'             => $priceTrade,
        ]);
    }
}