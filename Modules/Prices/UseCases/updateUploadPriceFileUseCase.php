<?php

namespace Modules\Prices\UseCases;

use Modules\Prices\Http\Requests\UpdatePriceFileRequest;
use Modules\Prices\Models\PricesUploaded;

class updateUploadPriceFileUseCase
{
    public function execute(UpdatePriceFileRequest $request)
    {
        $priceUpload = PricesUploaded::find($request['price_id']);
        $timestamp   = now();

        if (!$priceUpload) {
            throw new \Exception('Not found');
        }

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