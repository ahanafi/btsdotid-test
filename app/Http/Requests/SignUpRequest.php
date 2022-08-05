<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SignUpRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
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
            'user.username' => 'required',
            'user.email' => 'required',
            'user.encrypted_password' => 'required',
            'user.phone' => 'required',
            'user.address' => 'required',
            'user.city' => 'required',
            'user.country' => 'required',
            'user.name' => 'required',
            'user.postcode' => 'required'
        ];
    }
}
