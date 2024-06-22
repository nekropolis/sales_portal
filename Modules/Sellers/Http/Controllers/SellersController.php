<?php

namespace Modules\Sellers\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;
use Modules\Sellers\Http\Requests\CreateSellerRequest;
use Modules\Sellers\Http\Requests\UpdateSellerRequest;
use Modules\Sellers\UseCases\addSellerUseCase;
use Modules\Sellers\UseCases\deleteSellerUseCase;
use Modules\Sellers\UseCases\getTableSellersUseCase;
use Modules\Sellers\UseCases\updateSellerUseCase;

class SellersController extends Controller
{
    use ResponseTrait;
    public function addSeller(CreateSellerRequest $request,addSellerUseCase $useCase){
        try {
            return $useCase->execute($request);
        } catch (\Exception $e) {
            return $this->responseUnprocessable(['Can\'t get messages'.$e->getMessage()]);
        }
    }

    public function updateSeller(UpdateSellerRequest $request, updateSellerUseCase $useCase){
        try {
            return $useCase->execute($request);
        } catch (\Exception $e) {
            return $this->responseUnprocessable(['Can\'t get messages'.$e->getMessage()]);
        }
    }

    public function listSeller(){

        return view('sellers::sellers');

    }

    public function getTableSellers(Request $request, getTableSellersUseCase $useCase){
        try {
            return $useCase->execute($request);
        } catch (\Exception $e) {
            return $this->responseUnprocessable(['Can\'t get messages'.$e->getMessage()]);
        }
    }

    public function deleteSeller(Request $request, deleteSellerUseCase $useCase)
    {
        try {
            return $useCase->execute($request);
        } catch (\Exception $e) {
            return $this->responseUnprocessable(['Can\'t get messages'.$e->getMessage()]);
        }
    }
}