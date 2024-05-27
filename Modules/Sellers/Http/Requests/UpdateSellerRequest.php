<?php

namespace Modules\Sellers\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateSellerRequest extends FormRequest
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
                'name' => 'required|string',
            ];
        } else {
            return [];
        }
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Название поставщика обязательное поле!',
        ];
    }
}
