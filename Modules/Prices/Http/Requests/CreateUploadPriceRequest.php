<?php

namespace Modules\Prices\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class CreateUploadPriceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Auth::check();
    }

    public function rules(): array
    {
        return [
            'name'        => 'required|string',
            'seller_name' => 'required|integer',
            'file'        => 'required|file|mimes:xlsx,xls,csv,txt|max:10240',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'       => 'Название прайс-листа обязательное поле!',
            'file.required'       => 'Прикрепите файл для отправки в систему',
            'file.mimes'          => 'Проверьте тип файла, поддерживаются только xlsx,xls,csv,txt.',
            'file.max'            => 'Превышен максимальный размер 10mb',
            'seller_name.integer' => 'Выбирите поставщика из списка',
        ];
    }
}
