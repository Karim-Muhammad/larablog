<?php

namespace App\Http\Requests;

use App\Models\Category;
use Illuminate\Foundation\Http\FormRequest;

class StoreCategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // dd($this->user()->can("create", Category::class));
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
            //
            "name" => "required|string|unique:categories",
        ];
    }

    /**
     * Get the error messages for the defined validation rules. (Customize Error Messages)
     */
    public function messages(): array
    {
        return [
            "name.required" => "The :attribute is required!", // The category name is required! replace :atribute with what we defined in the attributes() method
            "name.unique" => "The :attribute must be unique broo!",
        ];
    }

    /**
     * Get custom attributes for validator errors. (Customize Field Names)
     */
    public function attributes(): array
    {
        return [
            "name" => "category name",
        ];
    }
}
