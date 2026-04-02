<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePropertyRequest extends FormRequest
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
            'name'         => 'required|string|max:255',
            'address'      => 'required|string|max:255',
            'city'         => 'required|string|max:100',
            'postal_code'  => 'nullable|string|max:10',
            'type'         => 'required|in:appartement,maison,studio,commercial,autre',
            'surface_m2'   => 'nullable|numeric|min:1',
            'monthly_rent' => 'required|numeric|min:0',
            'charges'      => 'nullable|numeric|min:0',
            'deposit'      => 'nullable|numeric|min:0',
            'status'       => 'required|in:occupee,vacante',
            'description'  => 'nullable|string',
        ];
    }
}
