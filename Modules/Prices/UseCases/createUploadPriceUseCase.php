<?php

namespace Modules\Prices\UseCases;

use Modules\Prices\Http\Requests\CreateUploadPriceRequest;
use Modules\Prices\Models\PricesUploaded;

class createUploadPriceUseCase
{
    public function execute(CreateUploadPriceRequest $request)
    {
        $fileModel = new PricesUploaded();

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