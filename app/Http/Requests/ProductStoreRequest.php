<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => [
                'required',
                Rule::unique('products')->whereNull('deleted_at'), // Учитывает SoftDeletes
            ],
            'count' => 'required|integer|min:1',
            'price' => 'required|integer',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Поле "Наименование продукта" обязательно для заполнения.',
            'name.unique' => 'Продукт с таким наименованием уже существует.',

            'count.required' => 'Поле "Колличество шт." обязательно для заполнения.',
            'count.integer' => 'Поле "Колличество шт." должно быть целым числом.',
            'count.min' => 'Количество должно быть не меньше 1.',

            'price.required' => 'Поле "Стоимость продукта руб. " обязательно для заполнения.',
            'price.integer' => 'Поле "Стоимость продукта руб. " должно быть целым числом.',
        ];
    }
}
