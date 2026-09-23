<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCategoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // أو تحقق من الصلاحيات لو محتاج
    }

    public function rules(): array
    {
        return [
            'name'      => 'required|string|max:255|unique:categories,name',
            'slug'      => 'required|string|max:255|unique:categories,slug',
            'image'     => 'nullable|image|mimes:jpg,jpeg,png,gif,webp|max:2048',
            'parent_id' => 'nullable|exists:categories,id',
        ];
    }
}
