<?php

namespace Modules\Localizations\UseCases;

use App\Traits\Makeable;
use Illuminate\Http\Request;
use Modules\Localizations\Models\Localizations;

class getLocalizationsTableUseCase
{
    use Makeable;

    public function execute(Request $request)
    {
        $data          = $request->all();
        $localizations = Localizations::query();

        if ($data['search']) {
            $localizations = $localizations->where('name', 'LIKE', "%{$data['search']}%");
        }

        $count         = $localizations->count();
        $localizations = $localizations
            ->limit($data['limit'])
            ->offset($data['offset'])
            ->get();

        return response()->json([
            'total'            => $count,
            'totalNotFiltered' => $count,
            'rows'             => $localizations,
        ]);
    }

}