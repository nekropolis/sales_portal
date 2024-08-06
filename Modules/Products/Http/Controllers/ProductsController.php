<?php

namespace Modules\Products\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Traits\ResponseTrait;
use Elasticsearch;
use Illuminate\Http\Request;
use Modules\Brands\Models\Brands;
use Modules\Categories\Models\Categories;
use Modules\Localizations\Models\Localizations;
use Modules\Products\Http\Requests\CreateProductRequest;
use Modules\Products\Http\Requests\DeleteProductRequest;
use Modules\Products\Http\Requests\UpdateProductRequest;
use Modules\Products\Models\Products;
use Modules\Products\UseCases\addProductUseCase;
use Modules\Products\UseCases\deleteProductUseCase;
use Modules\Products\UseCases\getProductsTableUseCase;
use Modules\Products\UseCases\updateProductUseCase;

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

        $brands        = Brands::all();
        $categories    = Categories::all();
        $localizations = Localizations::all();

        return view('products::products', [
            'products'       => $products,
            'brands'         => $brands,
            'categories'     => $categories,
            'localizations'  => $localizations,
            'showPagination' => is_null($q),
        ]);
    }

    public function create(CreateProductRequest $request, addProductUseCase $useCase)
    {
        try {
            return $useCase->execute($request);
        } catch (\Exception $e) {
            return $this->responseUnprocessable(['Can\'t get messages'.$e->getMessage()]);
        }
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
            return $useCase->execute($request);
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
