<?php

namespace Modules\Brands\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;
use Modules\Brands\Http\Requests\CreateBrandRequest;
use Modules\Brands\Http\Requests\DeleteBrandRequest;
use Modules\Brands\Http\Requests\UpdateBrandRequest;
use Modules\Brands\Models\Brands;
use Modules\Brands\UseCases\getBrandsTableUseCase;
use Modules\Brands\UseCases\updateBrandsUseCase;
use Modules\Products\Models\Products;

class BrandsController extends Controller
{
    use ResponseTrait;

    public function list()
    {
        $brands = Brands::paginate(15);

        //dd($products);

        return view('brands::brands', ['brands' => $brands,]);
    }

    public function create(CreateBrandRequest $request)
    {
        $data = $request->all();
        //dd($data);

        $brands       = new Brands();
        $brands->name = $data['name'];
        $brands->save();

        flash()->success('Бренд добавлен!');

        return redirect()->back();
    }

    public function show(Brands $brands)
    {
        //
    }

    public function update(UpdateBrandRequest $request, updateBrandsUseCase $useCase)
    {
         try {
             return $useCase->execute($request);
         } catch (\Exception $e) {
             return $this->responseUnprocessable(['Can\'t get messages'.$e->getMessage()]);
         }
    }

    public function delete(DeleteBrandRequest $request)
    {
        $data = $request->all();

        $brand            = Brands::findOrFail($data['brand_id']);
        $checkDeleteBrand = Products::where('brand_id', $data['brand_id'])->get()->count();

        if ($checkDeleteBrand) {

            return flash()->error('Бренд присутсвует в каталоге, нельзя удлить.');
        }

        $brand->delete();

        return flash()->success('Бренд удален!');
    }

    public function getBrandsTable(Request $request, getBrandsTableUseCase $useCase)
    {
        try {
            return $useCase->execute($request);
        } catch (\Exception $e) {
            return $this->responseUnprocessable(['Can\'t get messages'.$e->getMessage()]);
        }
    }
}
