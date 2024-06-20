<?php

namespace Modules\Currency\UseCases;

use App\Traits\Makeable;
use Illuminate\Http\Request;
use Modules\Categories\Models\Categories;
use Modules\Currency\Models\Currency;

class getCurrencyTableUseCase
{
    use Makeable;

    public function execute(Request $request)
    {
        $data = $request->all();
        //dd($request->all());

        $currency = Currency::query();

        if ($data['search']) {
            $currency = $currency
                ->where('name', 'LIKE', "%{$data['search']}%")
                ->orWhere('code', 'LIKE', "%{$data['search']}%");
        }

        $count    = $currency->count();
        $currency = $currency
            ->limit($data['limit'])
            ->offset($data['offset'])
            ->get();

        return response()->json([
            'total'            => $count,
            'totalNotFiltered' => $count,
            'rows'             => $currency,
        ]);
    }

}