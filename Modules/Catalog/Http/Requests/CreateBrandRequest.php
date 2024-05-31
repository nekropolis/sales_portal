<?php

namespace Modules\Catalog\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class CreateBrandRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Auth::check();
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Название бренда обязательное поле!',
        ];
    }
}
