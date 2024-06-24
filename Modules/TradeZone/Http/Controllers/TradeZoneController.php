<?php

namespace Modules\TradeZone\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;
use Modules\TradeZone\UseCases\createRuleTradePriceUseCase;
use Modules\TradeZone\UseCases\deleteRuleTradePriceUseCase;
use Modules\TradeZone\UseCases\editRuleTradePriceUseCase;
use Modules\TradeZone\UseCases\formTradePriceUseCase;
use Modules\TradeZone\UseCases\getTableTradePriceUseCase;
use Modules\TradeZone\UseCases\getTradePriceUseCase;
use Modules\TradeZone\UseCases\rulesTableTradePriceUseCase;
use Modules\TradeZone\UseCases\setCurrencyTradePriceUseCase;
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

    public function formTradePrice(Request $request, formTradePriceUseCase $useCase)
    {
        try {
            $useCase->execute($request);
        } catch (\Exception $e) {
            return $this->responseUnprocessable(['Can\'t get messages'.$e->getMessage()]);
        }
    }

    public function rulesTradePriceTable(Request $request, rulesTableTradePriceUseCase $useCase)
    {
        try {
            return $useCase->execute($request);
        } catch (\Exception $e) {
            return $this->responseUnprocessable(['Can\'t get messages'.$e->getMessage()]);
        }
    }

    public function createRuleTradePrice(Request $request, createRuleTradePriceUseCase $useCase)
    {
        try {
            return $useCase->execute($request);
        } catch (\Exception $e) {
            return $this->responseUnprocessable(['Can\'t get messages'.$e->getMessage()]);
        }
    }

    public function editRuleTradePrice(Request $request, editRuleTradePriceUseCase $useCase)
    {
        try {
            return $useCase->execute($request);
        } catch (\Exception $e) {
            return $this->responseUnprocessable(['Can\'t get messages'.$e->getMessage()]);
        }
    }

    public function deleteRuleTradePrice(Request $request, deleteRuleTradePriceUseCase $useCase)
    {
        try {
            return $useCase->execute($request);
        } catch (\Exception $e) {
            return $this->responseUnprocessable(['Can\'t get messages'.$e->getMessage()]);
        }
    }

    public function setCurrencyTradePrice(Request $request, setCurrencyTradePriceUseCase $useCase)
    {
        try {
            return $useCase->execute($request);
        } catch (\Exception $e) {
            return $this->responseUnprocessable(['Can\'t get messages'.$e->getMessage()]);
        }
    }
}
