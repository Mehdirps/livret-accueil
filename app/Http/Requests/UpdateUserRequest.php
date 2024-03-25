<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
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
            'civility' => ['required', Rule::in(['M.', 'Mme'])],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'phone' => 'nullable|string|regex:/^(\+\d{1,3})?\d{7,14}$/',
            'birth_date' => ['nullable', 'date'],
            'address' => ['nullable', 'string', 'max:255'],
        ];
    }

    public function withValidator($validator)
    {
        $validator->sometimes('email', ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($this->user()->id)], function ($input) {
            return $input->admin_update === null;
        });

        $validator->sometimes('email', ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($this->admin_update)], function ($input) {
            return $input->admin_update !== null;
        });
    }
}
