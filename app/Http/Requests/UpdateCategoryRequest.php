<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCategoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $categoryId = $this->route('category')->id;

        return [
            'name'      => 'required|string|max:255|unique:categories,name,' . $categoryId,
            'slug'      => 'required|string|max:255|unique:categories,slug,' . $categoryId,
            'image'     => 'nullable|image|mimes:jpg,jpeg,png,gif,webp|max:2048',
            'parent_id' => 'nullable|exists:categories,id',
        ];
    }
}
