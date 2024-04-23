<?php

namespace Modules\ImportExelProducts\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\ImportExelProducts\Exports\ProductsExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Modules\ImportExelProducts\Imports\ProductsImport;

class ImportExelProductsController extends Controller
{
    /**
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function export()
    {
        return Excel::download(new ProductsExport, 'products.xlsx');
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
