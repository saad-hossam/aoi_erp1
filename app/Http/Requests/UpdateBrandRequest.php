<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBrandRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $brandId = $this->route('brand')->id;

        return [
            'name'  => 'required|string|max:255|unique:brands,name,' . $brandId,
            'slug'  => 'required|string|max:255|unique:brands,slug,' . $brandId,
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif,webp|max:2048',
        ];
    }
}
