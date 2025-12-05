<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => [
                'required', 
                'string', 
                'max:255',
                // Hanya izinkan huruf, angka, spasi, titik, koma, strip, dan tanda petik satu
                // Ini mencegah input karakter spesial seperti < > { } yang biasa dipakai untuk hacking (XSS)
                'regex:/^[a-zA-Z0-9\s\.\,\-\']+$/' 
            ],
            'email' => [
                'required',
                'string',
                'lowercase',
                'email', // Validasi format email ketat
                'max:255',
                Rule::unique(User::class)->ignore($this->user()->id), // Pastikan email belum dipakai orang lain
            ],
            'phoneNumber' => [
                'nullable', 
                'string', 
                'max:20',
                // Menolak input teks atau script berbahaya.
                'regex:/^[\d\+\-\(\)\s]+$/' 
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'name.regex' => 'Nama mengandung karakter yang tidak diizinkan (simbol aneh tidak diperbolehkan).',
            'phoneNumber.regex' => 'Nomor telepon hanya boleh berisi angka dan simbol telepon standar (+, -).',
        ];
    }
}