<?php

namespace App\Http\Requests\Category;

use Illuminate\Foundation\Http\FormRequest;

class StoreCategoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string'],
            'restaurant_id' => ['required', 'integer', 'exists:restaurants,id'],
            'is_active' => ['required', 'boolean'],
            'position' => ['required', 'numeric'],
        ];
    }
}
