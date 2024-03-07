<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LivretRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'livret_name' => 'required|string|max:255',
            'establishment_name' => 'required|string|max:255',
            'establishment_address' => 'required|string|max:255',
            'establishment_phone' => 'required|string|max:255',
            'establishment_email' => 'required|email|max:255',
            'establishment_website' => 'required|url|max:255',
        ];
    }
}
