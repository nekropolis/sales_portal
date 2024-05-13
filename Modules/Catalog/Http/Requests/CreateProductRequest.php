<?php

namespace Modules\Catalog\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class CreateProductRequest extends FormRequest
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
            'model' => 'required|max:128',
        ];
    }

    public function messages(): array
    {
        return [
            'model.required' => 'Наименование продутка обязательное поле!',
        ];
    }
}
