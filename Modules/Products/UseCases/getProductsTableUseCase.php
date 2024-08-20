<?php

namespace Modules\Products\UseCases;

use App\Traits\Makeable;
use Illuminate\Http\Request;
use Modules\Products\Models\Products;

class getProductsTableUseCase
{
    use Makeable;

    public function execute(Request $request)
    {
        $data = $request->all();

        if ($data['search'] == '') {
            $products = Products::with('category')
                ->with('brand')
                ->with('localization')
                ->limit($data['limit'])
                ->offset($data['offset'])
                ->get();

            $count = Products::count();
        } else {
            $products = Products::with('category')
                ->where('model','LIKE',"%{$data['search']}%")
                ->with('brand')
                ->with('localization')
                ->limit($data['limit'])
                ->offset($data['offset'])
                ->get();

            $count = Products::where('model','LIKE',"%{$data['search']}%")->count();
        }

        return response()->json([
            'total'            => $count,
            'totalNotFiltered' => $count,
            'rows'             => $products,
        ]);
    }

}