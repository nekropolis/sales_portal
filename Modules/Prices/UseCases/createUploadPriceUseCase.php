<?php

namespace Modules\Prices\UseCases;

use Modules\Currency\Models\Currency;
use Modules\Prices\Http\Requests\CreateUploadPriceRequest;
use Modules\Prices\Models\PricesUploaded;

class createUploadPriceUseCase
{
    public function execute(CreateUploadPriceRequest $request)
    {
        $fileModel = new PricesUploaded();

        $currencyId = Currency::where('code', $request['currency'])->first()->id;

        $fileName               = $request->file->getClientOriginalName();
        $filePath               = $request->file('file')->storeAs('uploads', $fileName, 'public');
        $fileModel->seller_id   = $request->seller_name;
        $fileModel->orig_name   = $fileName;
        $fileModel->name        = $request->name;
        $fileModel->file_path   = '/storage/'.$filePath;
        $fileModel->currency_id = $currencyId;
        $fileModel->save();
    }
}