<?php

namespace Modules\ImportExportExel\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\ImportExportExel\Exports\PriceTradeExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class exelPriceTradeController extends Controller
{
    /**
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function export()
    {
        return Excel::download(new PriceTradeExport(), 'price_'.date('Y:m:d').'.xlsx');
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function import(Request $request)
    {
       //
    }
}
