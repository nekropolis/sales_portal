<?php

namespace Modules\Categories\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;
use Modules\Categories\Http\Requests\CreateCategoryRequest;
use Modules\Categories\Http\Requests\DeleteCategoryRequest;
use Modules\Categories\Http\Requests\UpdateCategoryRequest;
use Modules\Categories\Models\Categories;
use Modules\Categories\UseCases\addCategoryUseCase;
use Modules\Categories\UseCases\deleteCategoryUseCase;
use Modules\Categories\UseCases\getCategoriesTableUseCase;
use Modules\Categories\UseCases\updateCategoryUseCase;
use Modules\Products\Models\Products;

class CategoriesController extends Controller
{
    use ResponseTrait;

    public function list()
    {
        $categories = Categories::paginate(15);

        return view('categories::categories', ['categories' => $categories,]);
    }

    public function create(CreateCategoryRequest $request, addCategoryUseCase $useCase)
    {
        try {
            return $useCase->execute($request);
        } catch (\Exception $e) {
            return $this->responseUnprocessable(['Can\'t get messages'.$e->getMessage()]);
        }
    }

    public function update(UpdateCategoryRequest $request, updateCategoryUseCase $useCase)
    {
        try {
            return $useCase->execute($request);
        } catch (\Exception $e) {
            return $this->responseUnprocessable(['Can\'t get messages'.$e->getMessage()]);
        }
    }

    public function delete(DeleteCategoryRequest $request, deleteCategoryUseCase $useCase)
    {
        try {
            return $useCase->execute($request);
        } catch (\Exception $e) {
            return $this->responseUnprocessable(['Can\'t get messages'.$e->getMessage()]);
        }
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
