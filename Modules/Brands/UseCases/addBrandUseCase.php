<?php

namespace Modules\Brands\UseCases;

use App\Traits\Makeable;
use Illuminate\Http\Request;
use Modules\Brands\Models\Brands;

class addBrandUseCase
{
    use Makeable;

    public function execute(Request $request)
    {
        $data = $request->all();

        $brand       = new Brands();
        $brand->name = $data['name'];
        $brand->save();

        flash()->success('Бренд добавлен!');

        return redirect()->back();
    }
}