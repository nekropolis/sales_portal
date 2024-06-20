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
        //dd($request->all());
        if ($data['search'] == '') {
            $products = Products::with('category')
                ->with('brand')
                ->limit($data['limit'])
                ->offset($data['offset'])
                ->get();

            $count = Products::all()->count();
        } else {
            $products = Products::with('category')
                ->where('model','LIKE',"%{$data['search']}%")
                ->with('brand')
                ->limit($data['limit'])
                ->offset($data['offset'])
                ->get();

            $count = Products::where('model','LIKE',"%{$data['search']}%")
                ->get()
                ->count();
        }

        return response()->json([
            'total'            => $count,
            'totalNotFiltered' => $count,
            'rows'             => $products,
        ]);
    }

}