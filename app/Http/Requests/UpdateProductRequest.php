<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

class UpdateProductRequest extends BaseValidationRequest
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
            'name' => [Rule::unique('products')->ignore($this->id)->whereNull('deleted_at'), 'nullable', 'min:2'],
            'description' => ['nullable'],
            'price' => ['nullable'],
            'image' => ['file','mimes:png,jpg,jpeg']
        ];
    }
}
