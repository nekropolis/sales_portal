<?php

namespace Modules\Prices\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdatePriceFileRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Auth::check();
    }

    public function rules(): array
    {
        return [
            'file'        => 'required|file|mimes:xlsx,xls,csv|max:10240',
        ];
    }

    public function messages(): array
    {
        return [
            'file.required' => 'Прикрепите файл для отправки в систему',
            'file.mimes'    => 'Проверьте тип файла, поддерживаются только xlsx,xls,csv,txt.',
            'file.max'      => 'Превышен максимальный размер 10mb',
        ];
    }
}
