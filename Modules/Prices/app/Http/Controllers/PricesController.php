<?php

namespace Modules\Prices\app\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;
use Modules\Prices\Models\PricesUploaded;
use Modules\Prices\UseCases\getPriceUseCase;
use Modules\Prices\UseCases\getUploadedPricesUseCase;
use Modules\Prices\UseCases\parsePriceUseCase;
use Modules\Prices\UseCases\updateUploadedPriceUseCase;

class PricesController extends Controller
{
    use ResponseTrait;

    public function listUploadedPrices(getUploadedPricesUseCase $useCase)
    {
        try {
            return $useCase->execute();
        } catch (\Exception $e) {
            return $this->responseUnprocessable(['Can\'t get messages'.$e->getMessage()]);
        }
    }

    public function updateUploadPrice(Request $request, updateUploadedPriceUseCase $useCase)
    {
        try {
            return $useCase->execute($request);
        } catch (\Exception $e) {
            return $this->responseUnprocessable(['Can\'t get messages'.$e->getMessage()]);
        }
    }

    public function deleteUploadPrice(Request $request)
    {
        $data = $request->all();

        PricesUploaded::where('id', $data['price_id'])->delete();

        return response()->json(["success" => "Прайс удален!"]);
    }

    public function fileUpload(Request $request)
    {
        /*        $req->validate([
                    'file' => 'required|mimes:csv,txt,xlx,xls,pdf|max:2048'
                ]);*/
        $fileModel = new PricesUploaded();
        if ($request->file()) {
            $fileName             = $request->file->getClientOriginalName();
            $filePath             = $request->file('file')->storeAs('uploads', $fileName, 'public');
            $fileModel->seller_id = $request->seller_name;
            $fileModel->orig_name = $fileName;
            $fileModel->name      = $request->name;
            $fileModel->file_path = '/storage/'.$filePath;
            $fileModel->save();

            return back()
                ->with('success', 'File has been uploaded.')
                ->with('file', $fileName);
        }
    }

    public function fileUpdateUpload(Request $request)
    {
        /*        $req->validate([
                    'file' => 'required|mimes:csv,txt,xlx,xls,pdf|max:2048'
                ]);*/
        //dd($request['price_id'], $request->file());

        $priceUpload = PricesUploaded::find($request['price_id']);
        $timestamp   = now();

        if ($priceUpload) {
            if ($request->file()) {
                $fileName                = $request->file->getClientOriginalName();
                $filePath                = $request->file('file')->storeAs('uploads', $fileName, 'public');
                $priceUpload->file_path  = '/storage/'.$filePath;
                $priceUpload->updated_at = $timestamp;
                $priceUpload->update();

                return back()
                    ->with('success', 'File has been update.')
                    ->with('file', $fileName);
            }
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

    public function getPrice($id, getPriceUseCase $useCase)
    {
        try {
            return $useCase->execute($id);
        } catch (\Exception $e) {
            return $this->responseUnprocessable(['Can\'t get messages'.$e->getMessage()]);
        }
    }
}