<?php

namespace Modules\Prices\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;
use Modules\Prices\Http\Requests\UpdatePriceFileRequest;
use Modules\Prices\Http\Requests\CreateUploadPriceRequest;
use Modules\Prices\Http\Requests\UpdateUploadPriceRequest;
use Modules\Prices\UseCases\deleteUploadedPriceUseCase;
use Modules\Prices\UseCases\getPriceParseUseCase;
use Modules\Prices\UseCases\getTableLinkUseCase;
use Modules\Prices\UseCases\getTableUploadPriceUseCase;
use Modules\Prices\UseCases\getUploadedPricesUseCase;
use Modules\Prices\UseCases\IsActiveUseCase;
use Modules\Prices\UseCases\IsLinkUseCase;
use Modules\Prices\UseCases\parsePriceUseCase;
use Modules\Prices\UseCases\searchProductForPriceUseCase;
use Modules\Prices\UseCases\updateUploadedPriceUseCase;
use Modules\Prices\UseCases\createUploadPriceUseCase;
use Modules\Prices\UseCases\updateUploadPriceFileUseCase;

class PricesController extends Controller
{
    use ResponseTrait;

    public function createUploadPrice(CreateUploadPriceRequest $request, createUploadPriceUseCase $useCase)
    {
        try {
            $useCase->execute($request);

            return redirect()->back()->with('success', 'Файл загружен!.');
        } catch (\Exception $e) {
            return $this->responseUnprocessable(['Can\'t get messages'.$e->getMessage()]);
        }
    }

    public function listUploadedPrices(getUploadedPricesUseCase $useCase)
    {
        try {
            return $useCase->execute();
        } catch (\Exception $e) {
            return $this->responseUnprocessable(['Can\'t get messages'.$e->getMessage()]);
        }
    }

    public function updateUploadPrice(UpdateUploadPriceRequest $request, updateUploadedPriceUseCase $useCase)
    {
        try {
            return $useCase->execute($request);
        } catch (\Exception $e) {
            return $this->responseUnprocessable(['Can\'t get messages'.$e->getMessage()]);
        }
    }

    public function deleteUploadPrice(Request $request, deleteUploadedPriceUseCase $useCase)
    {
        try {
            $useCase->execute($request);

        } catch (\Exception $e) {
            return $this->responseUnprocessable(['Can\'t get messages'.$e->getMessage()]);
        }
    }

    public function fileUpdateUpload(UpdatePriceFileRequest $request, updateUploadPriceFileUseCase $useCase)
    {
        try {
            $useCase->execute($request);
            
            return back()->with('success', 'File has been update.');
        } catch (\Exception $e) {
            return $this->responseUnprocessable(['Can\'t get messages'.$e->getMessage()]);
        }
    }

    public function parsePrice(Request $request, parsePriceUseCase $useCase)
    {
        try {
            $useCase->execute($request);
        } catch (\Exception $e) {
            return $this->responseUnprocessable(['Can\'t get messages'.$e->getMessage()]);
        }
    }

    public function getPriceParse(Request $request, $id, getPriceParseUseCase $useCase)
    {
        try {
            return $useCase->execute($request, $id);
        } catch (\Exception $e) {
            return $this->responseUnprocessable(['Can\'t get messages'.$e->getMessage()]);
        }
    }

    public function searchProductPrice(Request $request, searchProductForPriceUseCase $useCase)
    {
        try {
            return $useCase->execute($request);
        } catch (\Exception $e) {
            return $this->responseUnprocessable(['Can\'t get messages'.$e->getMessage()]);
        }
    }

    function isLink(Request $request, IsLinkUseCase $useCase)
    {
        try {
            return $useCase->execute($request);
        } catch (\Exception $e) {
            return $this->responseUnprocessable(['Can\'t get messages'.$e->getMessage()]);
        }
    }

    function isActive(Request $request, IsActiveUseCase $useCase)
    {
        try {
            return $useCase->execute($request);
        } catch (\Exception $e) {
            return $this->responseUnprocessable(['Can\'t get messages'.$e->getMessage()]);
        }
    }

    public function getTableLink(Request $request, getTableLinkUseCase $useCase)
    {
        try {
            return $useCase->execute($request);
        } catch (\Exception $e) {
            return $this->responseUnprocessable(['Can\'t get messages'.$e->getMessage()]);
        }
    }

    public function getUploadPriceTable(Request $request, getTableUploadPriceUseCase $useCase)
    {
        try {
            return $useCase->execute($request);
        } catch (\Exception $e) {
            return $this->responseUnprocessable(['Can\'t get messages'.$e->getMessage()]);
        }
    }
}