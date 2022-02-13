<?php

namespace App\Http\Requests\Categories;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'news'  => ['required', 'array'],
            'title'       => ['required', 'string', 'min:5','max:200'],
            'description' => ['nullable', 'string'],
        ];
    }

    public function messages(): array
    {
        return [
            'required' => 'Необходимо заполнить поле :attribute'
        ];
    }

    public function attributes(): array
    {
        return [
            'title' => 'заголовок',
            'categories' => 'категория'
    ];
    }
}
