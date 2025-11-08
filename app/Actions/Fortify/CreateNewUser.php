<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique(User::class),
            ],
            'username' => [
                'required',
                'string',
                'max:32',
                'min:3',
                Rule::unique(User::class)
            ],
            'whatsapp_number' => [
                'required',
                'string',
                'max:15',
                'regex:/^[0-9]+$/',
                Rule::unique(User::class)
            ],
            'password' => $this->passwordRules(),
        ], [
            'whatsapp_number.required' => 'Nomor WhatsApp wajib diisi.',
            'whatsapp_number.max' => 'Nomor WhatsApp maksimal 15 digit.',
            'whatsapp_number.regex' => 'Nomor WhatsApp hanya boleh berisi angka.',
            'whatsapp_number.unique' => 'Nomor WhatsApp sudah digunakan.',
        ])->validate();

        return User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'username' => $input['username'],
            'whatsapp_number' => $input['whatsapp_number'],
            'password' => Hash::make($input['password']),
        ]);
    }
}
