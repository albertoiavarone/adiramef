<?php

namespace App\Actions\Fortify;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;
use App\Models\Role\Role;


class UpdateUserProfileInformation implements UpdatesUserProfileInformation
{
    /**
     * Validate and update the given user's profile information.
     *
     * @param  mixed  $user
     * @param  array  $input
     * @return void
     */
    public function update($user, array $input)
    {

        Validator::make($input, [
            //'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users')->ignore($user->id),
            ],
            'language' => 'string|max:3',
            'timezone' => 'string|exists:timezones,name',
            'phone_number' => 'nullable|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
        ])->validateWithBag('updateProfileInformation');


        if ($input['email'] !== $user->email &&
            $user instanceof MustVerifyEmail) {
            $this->updateVerifiedUser($user, $input);
        } else {

            $user->forceFill([
                //'name' => $input['name'],
                'email' => $input['email'],
                'language' => $input['language'],
                'timezone' => $input['timezone'],
                'phone_number' => isset($input['phone_number']) ? $input['phone_number'] : null,
                'phone_number_verified' => 0,
            ])->save();
            //update session locale if not equal
            if($user->language != session('locale')){
                session()->put('locale',$user->language);
            }
            
        }
    }

    /**
     * Update the given verified user's profile information.
     *
     * @param  mixed  $user
     * @param  array  $input
     * @return void
     */
    protected function updateVerifiedUser($user, array $input)
    {
        $user->forceFill([
            //'name' => $user['name'],
            'email' => $input['email'],
            'email_verified_at' => null,
        ])->save();
        $user->details()->update([
          'email' => $input['email'],
        ]);
        $user->sendEmailVerificationNotification();
    }
}
