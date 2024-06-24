<?php

namespace Modules\Brands\UseCases;

use App\Traits\Makeable;
use Illuminate\Http\Request;
use Modules\Brands\Models\Brands;

class getBrandsTableUseCase
{
    use Makeable;

    public function execute(Request $request)
    {
        $data = $request->all();

        $brands = Brands::query();

        if ($data['search']) {
            $brands = $brands->where('name', 'LIKE', "%{$data['search']}%");
        }

        $count  = $brands->count();
        $brands = $brands
            ->limit($data['limit'])
            ->offset($data['offset'])
            ->get();

        return response()->json([
            'total'            => $count,
            'totalNotFiltered' => $count,
            'rows'             => $brands,
        ]);
    }

}