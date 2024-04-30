<?php

namespace Modules\Prices\UseCases;

use App\Traits\Makeable;
use Illuminate\Http\Request;
use Modules\Prices\Models\LinkPrices;

class formPriceUseCase
{
    use Makeable;

    public function execute(Request $request, $id)
    {
        $price_uploaded_id = $id[0];

        $idsForInventories = LinkPrices::whereHas('priceParse', function ($query) use ($price_uploaded_id) {
            $query->where('price_uploaded_id', $price_uploaded_id);
        })
            ->where(['is_exist' => 1, 'is_link' => 1])
            ->select('product_id', 'price_model_id')
            ->get();

      /*  foreach ($idsForInventories as $idsForInventory) {
            $dataToUpdate = [
                'price'         => ,
                'margin_id'     => ,
                'currency_id'   => ,
                'qty'           => ,
                'import_status' => ,

            ];

            LinkPrices::query()->updateOrCreate([
                'product_id'     => $price->id,
                'price_model_id' => md5($price->model),
            ], $dataToUpdate);
        }*/

        /* $idsForInventories = [];
         foreach ($linkPrices as $linkPrice) {
             //dd($linkPrice->product->category->name);
             $idsForInventories['product_id'] = $linkPrice->product->category->name;
             $idsForInventories['price_model_id']    = $linkPrice->product->brand->name;
         }*/
        dd($idsForInventories);
    }
}