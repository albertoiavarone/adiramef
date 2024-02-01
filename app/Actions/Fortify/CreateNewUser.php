<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use App\Models\Role\Role;
use App\Models\Social\Invitation;
use App\Classes\Subscriptions;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
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
            'password' => $this->passwordRules(),
            'role' => 'nullable|exists:roles,name',
        ])->validate();
        
        $role = Role::default()->first();
        if(!is_null($input['role'])){
            $selected_role = Role::where('name',$input['role'])->first();
            if($selected_role->on_register == 1) $role = $selected_role;
        } 
        
        $unique_code = checkUniqueCode('App\Models\User' ,'code',$length=8);
        $user = User::create([
                'name' => $input['name'],
                'email' => $input['email'],
                'password' => Hash::make($input['password']),
                'code' => $unique_code,
            ])->assignRole($role->name);
        $trialSubscription= new Subscriptions();
        $trialSubscription->setTrialSubscription($user);
        //update invitation status
        if(session('token_invite')){
            $invitation = Invitation::where('uuid',session('token_invite'))->firstOrFail();
            $array_log = $invitation->log;
            $array_log[] = [
                'action' => 'registered',
                'date' => \Carbon\Carbon::now()
            ];
            $invitation->update([
                'status' => 2,
                'log' => $array_log
            ]);
        }

        return $user;
    }
}
