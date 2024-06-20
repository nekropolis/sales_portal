<?php

namespace Modules\Categories\UseCases;

use App\Traits\Makeable;
use Illuminate\Http\Request;
use Modules\Categories\Models\Categories;

class getCategoriesTableUseCase
{
    use Makeable;

    public function execute(Request $request)
    {
        $data = $request->all();
        //dd($request->all());

        $categories = Categories::query();

        if ($data['search']) {
            $categories = $categories->where('name', 'LIKE', "%{$data['search']}%");
        }

        $count      = $categories->count();
        $categories = $categories
            ->limit($data['limit'])
            ->offset($data['offset'])
            ->get();

        return response()->json([
            'total'            => $count,
            'totalNotFiltered' => $count,
            'rows'             => $categories,
        ]);
    }

}