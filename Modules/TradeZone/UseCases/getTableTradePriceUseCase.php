<?php

namespace Modules\TradeZone\UseCases;


use App\Traits\Makeable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Modules\Prices\Models\Inventories;
use Modules\TradeZone\Models\RulesProcessor;

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
                ->with('priceParse.priceUploaded')
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
                ->with('priceParse.priceUploaded')
                ->with('product')
                ->with('currency')
                ->with('product.brand')
                ->with('product.category');
        }

        $count      = $table->get()->count();
        $priceTrade = $table->limit($data['limit'])->offset($data['offset'])->get();

        foreach ($priceTrade as $item) {
            $newPrice    = RulesProcessor::processed([
                'price'             => $item->price,
                'price_uploaded_id' => $item->priceParse->price_uploaded_id,
                'category_id'       => $item->product->category->id,
                'brand_id'          => $item->product->brand->id,
            ]);
            if (!$newPrice) {
                return response()->json([
                    'type'    => 'error',
                    'message' => 'Не активировано или не созданно ни одно правило наценки!',
                ]);
            }
            $item->price = $item->price.'('.$newPrice.')';
        }

        return response()->json([
            'total'            => $count,
            'totalNotFiltered' => $count,
            'rows'             => $priceTrade,
        ]);
    }
}
