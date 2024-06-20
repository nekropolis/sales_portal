<?php

namespace Modules\Currency\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;
use Mgcodeur\CurrencyConverter\Facades\CurrencyConverter;
use Modules\Currency\Http\Requests\CreateCurrencyRequest;
use Modules\Currency\Http\Requests\DeleteCurrencyRequest;
use Modules\Currency\Http\Requests\UpdateCurrencyRequest;
use Modules\Currency\Models\Currency;
use Modules\Currency\UseCases\getCurrencyTableUseCase;

class CurrencyController extends Controller
{
    use ResponseTrait;

    public function list()
    {
        $currencies = Currency::paginate(15);

        return view('currency::currency', ['currencies' => $currencies,]);
    }

    public function create(CreateCurrencyRequest $request)
    {
        $data = $request->all();
        //dd($data);

        $currency       = new Currency();
        $currency->name = $data['name'];
        $currency->code = $data['code'];
        $currency->save();

        return redirect()->back()->with('success', 'Валюта добавлена!');
    }

    public function show(Currency $currency)
    {
        //
    }

    public function update(UpdateCurrencyRequest $request)
    {
        $data = $request->all();

        //dd($data);
        $currency = Currency::findOrFail($data['currency_id']);
        if (!$currency) {
            throw new \Exception('Not found');
        }

        if (isset($data['name'])) {
            $currency->name = $data['name'];
            $currency->code = $data['code'];
            $currency->update();

        return redirect()->back()->with('success', 'Валюта обновлена!');
        } else {
            $currency->get()->toArray();

            return $currency;
        }
    }

    public function delete(DeleteCurrencyRequest $request)
    {
        $data = $request->all();

        $currency = Currency::findOrFail($data['currency_id']);
        $currency->delete();

        //return redirect()->back()->with('success', 'Бренд удален!');
    }

    public function uploadCurrency()
    {
        $currencies = CurrencyConverter::currencies()->get();

        foreach ( $currencies as $code=>$name) {
            Currency::query()->updateOrCreate([
                'code' => $code,
            ], ['name' => $name,]);
        }
    }

    public function getCurrencyTable(Request $request, getCurrencyTableUseCase $useCase)
    {
        try {
            return $useCase->execute($request);
        } catch (\Exception $e) {
            return $this->responseUnprocessable(['Can\'t get messages'.$e->getMessage()]);
        }
    }
}
