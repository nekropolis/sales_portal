<?php

namespace Modules\Categories\UseCases;

use App\Traits\Makeable;
use Illuminate\Http\Request;
use Modules\Categories\Models\Categories;

class updateCategoryUseCase
{
    use Makeable;

    public function execute(Request $request)
    {
        $data     = $request->all();
        $category = Categories::findOrFail($data['category_id']);
        $message = '';

        if (!$category) {
            throw new \Exception('Not found');
        }

        if (isset($data['name'])) {
            $category->name = $data['name'];
            $category->update();

            $message = 'Категория обновлена!';
        }

        $category->get()->toArray();


        return response()->json([
            'success'  => true,
            'message'  => $message,
            'category' => $category,
        ]);
    }
}