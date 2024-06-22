<?php

namespace Modules\Categories\UseCases;

use App\Traits\Makeable;
use Illuminate\Http\Request;
use Modules\Categories\Models\Categories;
use Modules\Products\Models\Products;

class deleteCategoryUseCase
{
    use Makeable;

    public function execute(Request $request)
    {
        $data = $request->all();

        $category            = Categories::findOrFail($data['category_id']);
        $checkDeleteCategory = Products::where('category_id', $data['category_id'])->get()->count();

        if ($checkDeleteCategory) {
            return response()->json([
                'type'    => 'error',
                'message' => 'Категория присутсвует в каталоге, нельзя удлить.',
            ]);
        }

        $category->delete();

        return response()->json([
            'type'    => 'success',
            'message' => 'Категория удалена!',
        ]);
    }
}