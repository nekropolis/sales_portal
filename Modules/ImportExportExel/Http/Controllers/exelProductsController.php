<?php

namespace Modules\ImportExportExel\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\ImportExportExel\Exports\ProductsExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Modules\ImportExportExel\Imports\ProductsImport;

class exelProductsController extends Controller
{
    /**
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function export()
    {
        return Excel::download(new ProductsExport, 'products_'.date('Y:m:d').'.xlsx');
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function import(Request $request)
    {
        // Validate incoming request data
        $request->validate([
            'file' => 'required|max:2048',
        ]);

        Excel::import(new ProductsImport, $request->file('file'));

        return back()->with('success', 'Users imported successfully.');
    }
}
