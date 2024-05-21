<?php

namespace Modules\TradeZone\UseCases;


use App\Traits\Makeable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Modules\Catalog\Models\Products;
use Modules\Prices\Models\Inventories;

class getTableTradePriceUseCase
{
    use Makeable;

    public function execute(Request $request)
    {
        $data = $request->all();

        $sameModel = Inventories::selectRaw('product_id, min(price) as price')->groupBy('product_id');

        if ($data['search'] == '') {
            $table = Inventories::join(DB::raw('('.$sameModel->toSql().') as sub'), function ($join) {
                $join->on('sub.price', '=', 'inventories.price');
                $join->on('sub.product_id', '=', 'inventories.product_id');
            })
                ->with('priceParse')
                ->with('product.parseModels.priceUploaded.currency')
                ->with('currency')
                ->with('product.brand')
                ->with('product.category');
        } else {
            $table = Inventories::join(DB::raw('('.$sameModel->toSql().') as sub'), function ($join) {
                $join->on('sub.price', '=', 'inventories.price');
                $join->on('sub.product_id', '=', 'inventories.product_id');
            })
                ->whereHas('product', function ($query) use ($data) {
                    $query->where('model', 'LIKE', "%{$data['search']}%");
                })
                ->with('priceParse')
                ->with('product')
                ->with('currency')
                ->with('product.brand')
                ->with('product.category');
        }

        $count      = $table->get()->count();
        $priceTrade = $table->limit($data['limit'])->offset($data['offset'])->get();

        //dd($priceTrade);

        return response()->json([
            'total'            => $count,
            'totalNotFiltered' => $count,
            'rows'             => $priceTrade,
        ]);
    }
}