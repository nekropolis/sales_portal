<?php

namespace Modules\Categories\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;
use Modules\Categories\Http\Requests\CreateCategoryRequest;
use Modules\Categories\Http\Requests\DeleteCategoryRequest;
use Modules\Categories\Http\Requests\UpdateCategoryRequest;
use Modules\Categories\Models\Categories;
use Modules\Categories\UseCases\getCategoriesTableUseCase;
use Modules\Categories\UseCases\updateCategoryUseCase;
use Modules\Products\Models\Products;

class CategoriesController extends Controller
{
    use ResponseTrait;
    public function list()
    {
        $categories = Categories::paginate(15);

        //dd($categories);

        return view('categories::categories', ['categories' => $categories,]);
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

    public function update(UpdateCategoryRequest $request, updateCategoryUseCase $useCase)
    {
        try {
             return $useCase->execute($request);
        } catch (\Exception $e) {
            return $this->responseUnprocessable(['Can\'t get messages'.$e->getMessage()]);
        }
    }

    public function delete(DeleteCategoryRequest $request)
    {
        $data = $request->all();

        $category            = Categories::findOrFail($data['category_id']);
        $checkDeleteCategory = Products::where('category_id', $data['category_id'])->get()->count();

        if ($checkDeleteCategory) {
            return back()->with('error', 'Категория присутсвует в каталоге, нельзя удлить.');
        }

        $category->delete();

        return redirect()->back()->with('success', 'Категория удалена!');
    }

    public function getCategoriesTable(Request $request, getCategoriesTableUseCase $useCase)
    {
        try {
            return $useCase->execute($request);
        } catch (\Exception $e) {
            return $this->responseUnprocessable(['Can\'t get messages'.$e->getMessage()]);
        }
    }
}
