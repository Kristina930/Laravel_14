<?php

namespace App\Http\Requests\Categories;

use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
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
            'categories'  => ['required', 'array'],
            'title'       => ['required', 'string', 'min:5','max:200'],
            'author'      => ['required', 'string', 'min:2', 'max:50'],
            'status'      => ['required', 'string', 'min:4', 'max:8'],
            'isImage'     => ['nullable', 'boolean'],
            'image'       => ['nullable', 'file', 'image', 'mimes:jpg,png'],
            'description' => ['nullable', 'string'],
        ];
    }
}
