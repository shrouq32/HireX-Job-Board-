<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEmployerRequest extends FormRequest
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
            'company_name'=>'required|string|max:100',
            'company_description'=>'required|string|max:300',
            'company_website'=>'nullable|url|max:255',
            'phone' => 'required|numeric|digits_between:7,15|unique:employers,phone',
        ];
    }
}
