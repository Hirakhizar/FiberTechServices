<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddServiceRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
                'name' => 'required|string|max:255',
                'thumbnail' => 'required|image|mimes:jpg,jpeg,png|max:2048',
                'category_id' => 'required|exists:categories,id',
                'section_images.*' => 'required|image|mimes:jpg,jpeg,png|max:2048',
                'section_contents.*' => 'required|string',
                'meta_title' =>'required|string',
                'meta_description' =>'required|string',
                'data.*' => 'nullable|string',
        ];
    }
}
