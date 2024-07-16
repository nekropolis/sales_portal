<?php

namespace Modules\Prices\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateUploadPriceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Auth::check();
    }

    public function rules(): array
    {
        $data = $this->request->all();

        if (isset($data['name'])) {
            return [
                'name'        => 'required|string',
                'model_name'  => 'required|string',
                'price_name'  => 'required|string',
                'currency_id' => 'required|integer|gt:0',
            ];
        } else {
            return [];
        }

    }

    public function messages(): array
    {
        return [
            'name.required'        => 'Название прайс-листа обязательное поле!',
            'model_name.required'  => 'Название колонки с наименованием обязательное поле!',
            'price_name.required'  => 'Название колонки с ценой обязательное поле!',
            'currency_id.required' => 'Выбирите валюту!',
        ];
    }
}
