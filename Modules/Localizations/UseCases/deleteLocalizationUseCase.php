<?php

namespace Modules\Localizations\UseCases;

use App\Traits\Makeable;
use Illuminate\Http\Request;
use Modules\Localizations\Models\Localizations;
use Modules\Products\Models\Products;

class deleteLocalizationUseCase
{
    use Makeable;

    public function execute(Request $request)
    {
        $data = $request->all();

        $localization            = Localizations::findOrFail($data['localization_id']);
        $checkDeleteLocalization = Products::where('localization_id', $data['localization_id'])->get()->count();

        if ($checkDeleteLocalization) {
            return response()->json([
                'type'    => 'error',
                'message' => 'Локализация присутсвует в каталоге, нельзя удлить.',
            ]);
        }

        $localization->delete();

        return response()->json([
            'type'    => 'success',
            'message' => 'Локализация удалена!',
        ]);
    }
}