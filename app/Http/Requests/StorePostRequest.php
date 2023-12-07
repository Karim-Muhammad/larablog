<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
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
            //
            "title" => "required|string|max:255",
            "slug" => "required|string|max:255|unique:posts",
            "description" => "required|min:20",
            "body" => "required|min:30",
            "image" => "required|file",
            "category_id" => "required|numeric",
        ];
    }

    public function attributes()
    {
        return [
            "body" => "blog's content",
            "image" => "blog's image",
            "category_id" => "category",
        ];
    }

    public function messages()
    {
        return [
            "image.required" => ":attribute must be selected!",
            "body.min" => ":attribute must be more than :min"
        ];
    }
}
