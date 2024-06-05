<?php

namespace Modules\Catalog\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;
use Modules\Catalog\Http\Requests\CreateProductRequest;
use Modules\Catalog\Http\Requests\DeleteProductRequest;
use Modules\Catalog\Http\Requests\UpdateProductRequest;
use Modules\Catalog\Models\Brands;
use Modules\Catalog\Models\Categories;
use Modules\Catalog\Models\Products;
use Elasticsearch;
use Modules\Catalog\UseCases\deleteProductUseCase;
use Modules\Catalog\UseCases\getProductsTableUseCase;
use Modules\Catalog\UseCases\updateProductUseCase;
use Modules\Prices\Models\Inventories;
use Modules\Prices\Models\LinkPrices;
use Modules\TradeZone\Models\PriceModelsInProduct;

class ProductsController extends Controller
{
    use ResponseTrait;

    public function list(Request $request)
    {
        $q = $request->get('q');

        if ($q) {
            $response = Elasticsearch::search([
                'index' => 'products',
                "size"  => 20,
                'body'  => [
                    'query' => [
                        'multi_match' => [
                            'query'  => $q,
                            'fields' => ['brand', 'model'],
                        ],
                    ],
                ],
            ]);

            $productIds = array_column($response['hits']['hits'], '_id');
            $products   = Products::query()->findMany($productIds);
        } else {
            $products = Products::paginate(20);
        }

        $brands     = Brands::all();
        $categories = Categories::all();

        return view('catalog::products', [
            'products'       => $products,
            'brands'         => $brands,
            'categories'     => $categories,
            'showPagination' => is_null($q),
        ]);
    }

    public function create(CreateProductRequest $request)
    {
        $data = $request->all();

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

    /**
     * @throws \Exception
     */
    public function update(UpdateProductRequest $request, updateProductUseCase $useCase)
    {
        try {
            return $useCase->execute($request);
        } catch (\Exception $e) {
            return $this->responseUnprocessable(['Can\'t get messages'.$e->getMessage()]);
        }
    }

    public function delete(DeleteProductRequest $request, deleteProductUseCase $useCase)
    {
        try {
            $useCase->execute($request);

            return back()->with('success', 'Продукт удален!');
        } catch (\Exception $e) {
            return $this->responseUnprocessable(['Can\'t get messages'.$e->getMessage()]);
        }
    }

    public function getProductsTable(Request $request, getProductsTableUseCase $useCase)
    {
        try {
            return $useCase->execute($request);
        } catch (\Exception $e) {
            return $this->responseUnprocessable(['Can\'t get messages'.$e->getMessage()]);
        }
    }
}
