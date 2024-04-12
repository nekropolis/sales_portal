<?php

namespace Modules\Catalog\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Catalog\Entities\Brands;
use Modules\Catalog\Entities\Categories;
use Modules\Catalog\Entities\Products;
use Modules\Catalog\Http\Requests\CreateProductRequest;
use Modules\Catalog\Http\Requests\UpdateProductRequest;

class ProductsController extends Controller
{
    public function list()
    {
        $products = Products::paginate(15);

        //dd($products);

        $brands     = Brands::all();
        $categories = Categories::all();

        return view('catalog::products', [
            'products'   => $products,
            'brands'     => $brands,
            'categories' => $categories,
        ]);
    }

    public function create(CreateProductRequest $request)
    {
        $data = $request->all();
        //dd($data);

        $products               = new Products();
        $products->sku          = $data['sku'];
        $products->brand_id     = $data['brand'];
        $products->category_id  = $data['category'];
        $products->model        = $data['model'];
        $products->localization = $data['localization'];
        $products->package      = $data['package'];
        $products->condition    = $data['condition'];
        $products->save();

        return redirect()->back()->with('success', 'Продукт добавлен!');
    }

    public function show(Products $products)
    {
        //
    }

    public function update(UpdateProductRequest $request, Products $products)
    {
        //
    }

    public function delete(Products $products)
    {
        //
    }
}
