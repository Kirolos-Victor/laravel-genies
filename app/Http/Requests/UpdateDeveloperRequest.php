<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class UpdateDeveloperRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $developer = $this->route('developer');
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email:filter', 'unique:developers,email,' . $developer->id],
            'password' => ['nullable', 'confirmed'],
            'username' => ['required', 'string', 'max:255']
        ];
    }

    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        $response = response()->json(['errors' => $validator->errors()->all()], 422);
        throw new ValidationException($validator, $response);
    }
}
