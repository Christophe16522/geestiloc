<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDocumentRequest extends FormRequest
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
            'name'            => 'required|string|max:255',
            'property_id'     => 'nullable|exists:properties,id',
            'category'        => 'required|in:contrat,diagnostic,quittance,assurance,autre',
            'expiration_date' => 'nullable|date',
            'file'            => 'required|file|max:10240',
        ];
    }
}
