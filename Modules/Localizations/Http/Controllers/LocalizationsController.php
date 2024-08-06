<?php

namespace Modules\Localizations\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;
use Modules\Localizations\Http\Requests\CreateLocalizationRequest;
use Modules\Localizations\Http\Requests\DeleteLocalizationRequest;
use Modules\Localizations\Http\Requests\UpdateLocalizationRequest;
use Modules\Localizations\Models\Localizations;
use Modules\Localizations\UseCases\addLocalizationUseCase;
use Modules\Localizations\UseCases\deleteLocalizationUseCase;
use Modules\Localizations\UseCases\getLocalizationsTableUseCase;
use Modules\Localizations\UseCases\updateLocalizationUseCase;

class LocalizationsController extends Controller
{
    use ResponseTrait;

    public function list()
    {
        $localizations = Localizations::paginate(15);

        return view('localizations::localizations', ['localizations' => $localizations,]);
    }

    public function create(CreateLocalizationRequest $request, addLocalizationUseCase $useCase)
    {
        try {
            return $useCase->execute($request);
        } catch (\Exception $e) {
            return $this->responseUnprocessable(['Can\'t get messages'.$e->getMessage()]);
        }
    }

    public function update(UpdateLocalizationRequest $request, updateLocalizationUseCase $useCase)
    {
        try {
            return $useCase->execute($request);
        } catch (\Exception $e) {
            return $this->responseUnprocessable(['Can\'t get messages'.$e->getMessage()]);
        }
    }

    public function delete(DeleteLocalizationRequest $request, deleteLocalizationUseCase $useCase)
    {
        try {
            return $useCase->execute($request);
        } catch (\Exception $e) {
            return $this->responseUnprocessable(['Can\'t get messages'.$e->getMessage()]);
        }
    }

    public function getLocalizationsTable(Request $request, getLocalizationsTableUseCase $useCase)
    {
        try {
            return $useCase->execute($request);
        } catch (\Exception $e) {
            return $this->responseUnprocessable(['Can\'t get messages'.$e->getMessage()]);
        }
    }
}
