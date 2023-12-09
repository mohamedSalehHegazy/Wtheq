<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

class RegisterRequest extends BaseValidationRequest
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
            'name' => ['required', 'min:2'],
            'username' => [Rule::unique('users')->ignore($this->id)->whereNull('deleted_at')],
            'password' => 'required|confirmed|string|min:8|regex:/^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z]).{8,}$/',
            'type' => ['integer','in:1,2,3'],
            'avatar' => ['file','mimes:jpg,jpeg,png']
        ];
    }
}
