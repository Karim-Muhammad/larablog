<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use PHPUnit\TextUI\Output\Default\ProgressPrinter\TestRunnerExecutionStartedSubscriber;

class UpdatePostRequest extends FormRequest
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
            "title" => "required|string|min:10|max:255",
            "description" => "required|string|min:20|max:255",
            "body" => "required|string|min:30",
            // "image" => "required|image|mimes:jpeg,png,jpg,gif,svg|max:2048",
            "category_id" => "required|integer|exists:categories,id",
        ];
    }
}
