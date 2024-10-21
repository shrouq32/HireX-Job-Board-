<?php

namespace App\Http\Requests;
use Illuminate\Validation\Rule;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEmployerRequest extends FormRequest
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
            'company_name' => 'required|string|max:255',
            'company_description' => 'required|string|max:300',
            'company_website' => 'nullable|url|max:255',
            'phone' => [
                'required',
                'string',
                'max:20',
                Rule::unique('employers')->ignore($this->employer),
            ],  

        ];

    }

    /**
     * Get the custom validation messages.
     *
     * @return array<string, string>
     */

     public function messages(): array
     {
        
         return [
             'company_name.required' => 'Company name is required.',
             'company_description.required' => 'Company description is required.',
             'phone.required' => 'Phone number is required.',
             'phone.unique' => 'This phone number is already registered.',
         ];
     }
}
