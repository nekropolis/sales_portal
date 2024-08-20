<?php

namespace Modules\Sellers\UseCases;

use App\Traits\Makeable;
use Illuminate\Http\Request;
use Modules\Sellers\Models\Sellers;

class getTableSellersUseCase
{
    use Makeable;

    public function execute(Request $request)
    {
        $data = $request->all();

        if ($data['search'] == '') {
            $sellers = Sellers::query()
                ->limit($data['limit'])
                ->offset($data['offset'])
                ->get();

            $count = Sellers::count();
        } else {
            $sellers = Sellers::query()
                ->where('name', 'LIKE', "%{$data['search']}%")
                ->limit($data['limit'])
                ->offset($data['offset'])
                ->get();

            $count = Sellers::where('name', 'LIKE', "%{$data['search']}%")->count();
        }

        return response()->json([
            'total'            => $count,
            'totalNotFiltered' => $count,
            'rows'             => $sellers,
        ]);
    }
}