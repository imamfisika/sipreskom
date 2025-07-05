<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Auth;

class UpdatePasswordRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'current_password' => ['required', 'current_password'],
            'new_password' => [
                'required',
                'string',
                'min:8',
                'different:current_password',
                Password::min(8)
                    ->mixedCase()
                    ->letters()
                    ->numbers()
            ],
            'new_password_confirmation' => ['required', 'same:new_password'],
        ];
    }

    public function messages()
    {
        return [
            'current_password.required' => 'Password saat ini wajib diisi.',
            'current_password.current_password' => 'Password saat ini salah.',
            'new_password.required' => 'Password baru wajib diisi.',
            'new_password.different' => 'Password baru tidak boleh sama dengan password lama.',
            'new_password_confirmation.same' => 'Konfirmasi password tidak cocok.',
        ];
    }
}