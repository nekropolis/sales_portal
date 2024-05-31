<?php

namespace Modules\Catalog\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class CreateCurrencyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check();
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'code' => 'required|string',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Название валюты обязательное поле!',
            'code.required' => 'Код валюты обязательное поле!',
        ];
    }
}
