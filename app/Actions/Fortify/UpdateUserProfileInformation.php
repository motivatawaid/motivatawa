<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;

class UpdateUserProfileInformation implements UpdatesUserProfileInformation
{
    /**
     * Validate and update the given user's profile information.
     *
     * @param  array<string, string>  $input
     */
    public function update(User $user, array $input): void
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users')->ignore($user->id),
            ],
            'username' => [
                'required',
                'string',
                'max:32',
                'min:3',
                Rule::unique('users')->ignore($user->id)
            ],
            'whatsapp_number' => [
                'required',
                'string',
                'max:15',
                'regex:/^[0-9]+$/',
                Rule::unique('users')->ignore($user->id)
            ],
        ], [
            'whatsapp_number.required' => 'Nomor WhatsApp wajib diisi.',
            'whatsapp_number.max' => 'Nomor WhatsApp maksimal 15 digit.',
            'whatsapp_number.regex' => 'Nomor WhatsApp hanya boleh berisi angka.',
            'whatsapp_number.unique' => 'Nomor WhatsApp sudah digunakan.',
        ])->validateWithBag('updateProfileInformation');

        if (
            $input['email'] !== $user->email &&
            $user instanceof MustVerifyEmail
        ) {
            $this->updateVerifiedUser($user, $input);
        } else {
            $user->forceFill([
                'name' => $input['name'],
                'email' => $input['email'],
                'username' => $input['username'],
                'whatsapp_number' => $input['whatsapp_number'],
            ])->save();
        }
    }

    /**
     * Update the given verified user's profile information.
     *
     * @param  array<string, string>  $input
     */
    protected function updateVerifiedUser(User $user, array $input): void
    {
        $user->forceFill([
            'name' => $input['name'],
            'email' => $input['email'],
            'username' => $input['username'],
            'whatsapp_number' => $input['whatsapp_number'],
            'email_verified_at' => null,
        ])->save();

        // aktifkan ini jika .env email sudah di seting
        $user->sendEmailVerificationNotification();
    }
}
