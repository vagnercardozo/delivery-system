<?php

namespace App\Http\Requests\Category;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCategoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['sometimes', 'string'],
            'restaurant_id' => ['sometimes', 'integer', 'exists:restaurants,id'],
            'is_active' => ['sometimes', 'boolean'],
            'position' => ['sometimes', 'numeric'],
        ];
    }
}
