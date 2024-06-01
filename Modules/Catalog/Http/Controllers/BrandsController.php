<?php

namespace Modules\Catalog\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Catalog\Http\Requests\CreateBrandRequest;
use Modules\Catalog\Http\Requests\DeleteBrandRequest;
use Modules\Catalog\Http\Requests\UpdateBrandRequest;
use Modules\Catalog\Models\Brands;
use Modules\Catalog\Models\Products;

class BrandsController extends Controller
{
    public function list()
    {
        $brands = Brands::paginate(15);

        //dd($products);

        return view('catalog::brands', ['brands' => $brands,]);
    }

    public function create(CreateBrandRequest $request)
    {
        $data = $request->all();
        //dd($data);

        $brands       = new Brands();
        $brands->name = $data['name'];
        $brands->save();

        return redirect()->back()->with('success', 'Бренд добавлен!');
    }

    public function show(Brands $brands)
    {
        //
    }

    public function update(UpdateBrandRequest $request)
    {
        $data = $request->all();

        //dd($data);
        $brand = Brands::findOrFail($data['brand_id']);
        if (!$brand) {
            throw new \Exception('Not found');
        }

        if (isset($data['name'])) {
            $brand->name = $data['name'];
            $brand->update();

            return redirect()->back()->with('success', 'Бренд обновлен!');
        } else {
            $brand->get()->toArray();

            return $brand;
        }
    }

    public function delete(DeleteBrandRequest $request)
    {
        $data = $request->all();

        $brand            = Brands::findOrFail($data['brand_id']);
        $checkDeleteBrand = Products::where('brand_id', $data['brand_id'])->get()->count();

        if ($checkDeleteBrand) {
            return back()->with('error', 'Бренд присутсвует в каталоге, нельзя удлить.');
        }

        $brand->delete();

        return redirect()->back()->with('success', 'Бренд удален!');
    }
}
