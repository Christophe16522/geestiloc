<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateContractRequest extends FormRequest
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
            'tenant_id'    => 'required|exists:tenants,id',
            'property_id'  => 'required|exists:properties,id',
            'type'         => 'required|in:vide,meuble,commercial',
            'start_date'   => 'required|date',
            'end_date'     => 'nullable|date|after:start_date',
            'monthly_rent' => 'required|numeric|min:0',
            'charges'      => 'nullable|numeric|min:0',
            'deposit'      => 'nullable|numeric|min:0',
            'status'       => 'required|in:actif,expire,archive',
        ];
    }
}
