<?php

namespace Modules\TradeZone\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Traits\ResponseTrait;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Modules\Prices\Models\Inventories;
use Modules\TradeZone\UseCases\getTableTradePriceUseCase;
use Modules\TradeZone\UseCases\getTradePriceUseCase;
use Modules\TradeZone\UseCases\settingsTradePriceUseCase;

class TradeZoneController extends Controller
{
    use ResponseTrait;

    public function getTradePrice(Request $request, getTradePriceUseCase $useCase)
    {
        try {
            return $useCase->execute($request);
        } catch (\Exception $e) {
            return $this->responseUnprocessable(['Can\'t get messages'.$e->getMessage()]);
        }
    }

    public function settingsTradePrice(Request $request, settingsTradePriceUseCase $useCase)
    {
        try {
            return $useCase->execute($request);
        } catch (\Exception $e) {
            return $this->responseUnprocessable(['Can\'t get messages'.$e->getMessage()]);
        }
    }

    public function getTable(Request $request, getTableTradePriceUseCase $useCase)
    {
        try {
            return $useCase->execute($request);
        } catch (\Exception $e) {
            return $this->responseUnprocessable(['Can\'t get messages'.$e->getMessage()]);
        }
    }
}
