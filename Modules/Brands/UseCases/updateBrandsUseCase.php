<?php

namespace Modules\Brands\UseCases;

use App\Traits\Makeable;
use Illuminate\Http\Request;
use Modules\Brands\Models\Brands;

class updateBrandsUseCase
{
    use Makeable;

    public function execute(Request $request)
    {
        $data    = $request->all();
        $brand   = Brands::findOrFail($data['brand_id']);
        $message = '';

        if (!$brand) {
            throw new \Exception('Not found');
        }

        if (isset($data['name'])) {
            $brand->name = $data['name'];
            $brand->update();

            $message = 'Бренд обновлен!';
        }

        $brand->get()->toArray();

        return response()->json([
            'type' => 'success',
            'message' => $message,
            'brand'   => $brand,
        ]);
    }
}