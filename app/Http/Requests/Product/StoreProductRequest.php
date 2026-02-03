<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string'],
            'description' => ['required', 'string'],
            'price' => ['required', 'decimal:2'],
            'is_available' => ['sometimes', 'boolean'],
            'image_url' => ['sometimes', 'string'],
            'category_id' => ['required', 'integer', 'exists:categories,id'],
            'restaurant_id' => ['required', 'integer', 'exists:restaurants,id'],
        ];
    }
}
