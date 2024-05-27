<?php

namespace Modules\Sellers\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class CreateSellerRequest extends FormRequest
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
            'name.required' => 'Название поставщиа обязательное поле!',
        ];
    }
}
