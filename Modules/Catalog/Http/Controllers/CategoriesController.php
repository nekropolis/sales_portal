<?php

namespace Modules\Catalog\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Catalog\Http\Requests\CreateCategoryRequest;
use Modules\Catalog\Http\Requests\DeleteCategoryRequest;
use Modules\Catalog\Http\Requests\UpdateCategoryRequest;
use Modules\Catalog\Models\Categories;

class CategoriesController extends Controller
{
    public function list()
    {
        $categories = Categories::paginate(15);

        //dd($categories);

        return view('catalog::categories', ['categories' => $categories,]);
    }

    public function create(CreateCategoryRequest $request)
    {
        $data = $request->all();
        //dd($data);

        $categories       = new Categories();
        $categories->name = $data['name'];
        $categories->save();

        return redirect()->back()->with('success', 'Категоря добавлена!');
    }

    public function show(Categories $categories)
    {
        //
    }

    public function update(UpdateCategoryRequest $request)
    {
        $data = $request->all();

        //dd($data);
        $categories = Categories::findOrFail($data['category_id']);
        if (!$categories) {
            throw new \Exception('Not found');
        }

        if (isset($data['name'])) {
            $categories->name = $data['name'];
            $categories->update();

        return redirect()->back()->with('success', 'Категория обновлена!');
        } else {
            $categories->get()->toArray();

            return $categories;
        }
    }

    public function delete(DeleteCategoryRequest $request)
    {
        $data = $request->all();

        $category = Categories::findOrFail($data['category_id']);
        $category->delete();

        //return redirect()->back()->with('success', 'Бренд удален!');
    }
}
