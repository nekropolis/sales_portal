<?php

namespace Modules\Localizations\UseCases;

use App\Traits\Makeable;
use Illuminate\Http\Request;
use Modules\Localizations\Models\Localizations;

class addLocalizationUseCase
{
    use Makeable;

    public function execute(Request $request)
    {
        $data = $request->all();

        $localization       = new Localizations();
        $localization->name = $data['name'];
        $localization->save();

        flash()->success('Локализация добавлена!');

        return redirect()->back();
    }
}