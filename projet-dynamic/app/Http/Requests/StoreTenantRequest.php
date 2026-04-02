<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTenantRequest extends FormRequest
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
            'first_name'       => 'required|string|max:100',
            'last_name'        => 'required|string|max:100',
            'email'            => 'nullable|email|max:255',
            'phone'            => 'nullable|string|max:20',
            'property_id'      => 'nullable|exists:properties,id',
            'monthly_rent'     => 'required|numeric|min:0',
            'lease_start_date' => 'nullable|date',
            'payment_status'   => 'required|in:paye,attente,retard',
        ];
    }
}
