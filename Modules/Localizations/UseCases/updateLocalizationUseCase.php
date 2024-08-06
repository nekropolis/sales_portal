<?php

namespace Modules\Localizations\UseCases;

use App\Traits\Makeable;
use Illuminate\Http\Request;
use Modules\Localizations\Models\Localizations;

class updateLocalizationUseCase
{
    use Makeable;

    public function execute(Request $request)
    {
        $data         = $request->all();
        $localization = Localizations::findOrFail($data['localization_id']);
        $message      = '';

        if (!$localization) {
            throw new \Exception('Not found');
        }

        if (isset($data['name'])) {
            $localization->name = $data['name'];
            $localization->update();

            $message = 'Локализация обновлена!';
        }

        $localization->get()->toArray();

        return response()->json([
            'type'         => 'success',
            'message'      => $message,
            'localization' => $localization,
        ]);
    }
}