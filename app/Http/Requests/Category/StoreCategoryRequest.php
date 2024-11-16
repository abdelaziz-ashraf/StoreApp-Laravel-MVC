<?php

namespace App\Http\Requests\Category;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\ForbiddenNameRule;

class StoreCategoryRequest extends FormRequest
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
            'name' => [
                'required',
                'string',
                'min:3', 'max:255',
                "unique:categories,name",
                new ForbiddenNameRule
            ],
            'parent_id' => 'nullable|int|exists:categories,id',
            'image' => 'image',
            'status' => 'required|in:active,archived'
        ];
    }
}
