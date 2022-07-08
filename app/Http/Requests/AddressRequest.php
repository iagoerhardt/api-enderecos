<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddressRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:60',
            'street' => 'required|string|max:255',
            'complement' => 'nullable|string|max:255',
            'zip_code' => 'required|string|max:9',
            'neighborhood' => 'required|string|max:255',
        ];
    }
}
