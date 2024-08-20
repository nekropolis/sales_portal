<?php

namespace Modules\Brands\UseCases;

use App\Traits\Makeable;
use Illuminate\Http\Request;
use Modules\Brands\Models\Brands;
use Modules\Products\Models\Products;

class deleteBrandUseCase
{
    use Makeable;

    public function execute(Request $request)
    {
        $data = $request->all();

        $brand            = Brands::findOrFail($data['brand_id']);
        $checkDeleteBrand = Products::where('brand_id', $data['brand_id'])->count();

        if ($checkDeleteBrand) {
            return response()->json([
                'type'    => 'error',
                'message' => 'Бренд присутсвует в каталоге, нельзя удлить.',
            ]);
        }

        $brand->delete();

        return response()->json([
            'type'    => 'success',
            'message' => 'Бренд удален!',
        ]);
    }
}