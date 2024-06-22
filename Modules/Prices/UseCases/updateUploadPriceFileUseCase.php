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
        $priceUpload->orig_name  = $fileName;
        $priceUpload->file_path  = '/storage/'.$filePath;
        $priceUpload->updated_at = $timestamp;
        $priceUpload->update();

        flash()->success('Прайс-лист обновлен!');

        return redirect()->back();
    }
}