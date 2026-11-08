<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StaffUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'sometimes|required|string',
            'email' => 'sometimes|required|email|unique:staff,email',
            'password' => 'sometimes|required|string|min:8',
            'role' => 'sometimes|required|string',
            'phone_number' => 'sometimes|required|string|unique:staff,phone_number',
        ];
    }
}