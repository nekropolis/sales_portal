<?php

namespace Modules\Catalog\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Catalog\Http\Requests\CreateCurrencyRequest;
use Modules\Catalog\Http\Requests\DeleteCurrencyRequest;
use Modules\Catalog\Http\Requests\UpdateCurrencyRequest;
use Modules\Catalog\Models\Currency;
use Mgcodeur\CurrencyConverter\Facades\CurrencyConverter;

class CurrencyController extends Controller
{
    public function list()
    {
        $currencies = Currency::paginate(15);

        return view('catalog::currency', ['currencies' => $currencies,]);
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
}
