<?php

namespace Modules\Categories\UseCases;

use App\Traits\Makeable;
use Illuminate\Http\Request;
use Modules\Categories\Models\Categories;

class addCategoryUseCase
{
    use Makeable;

    public function execute(Request $request)
    {
        $data = $request->all();
        //dd($data);

        $categories       = new Categories();
        $categories->name = $data['name'];
        $categories->save();

        flash()->success('Категоря добавлена!');

        return redirect()->back();
    }
}