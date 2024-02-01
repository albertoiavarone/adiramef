<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Spatie\Permission\Traits\HasRoles;
use Laravel\Sanctum\HasApiTokens;
use Emadadly\LaravelUuid\Uuids;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable, TwoFactorAuthenticatable, HasRoles, HasApiTokens, Uuids;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'name',
        'email',
        'password',
        'provider',
        'provider_id',
        'image',
        'uuid',
        'email_verified_at',
        'language',
        'timezone',
        'code',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //Relations
    /*
    *relation for user details info
    *
    */
    public function details(){
        return $this->hasMany('App\Models\User\UserDetail');
    }

    public function subscriptions(){
        return $this->hasMany('App\Models\Commercial\Subscription');
    }

    public function orders(){
        return $this->hasMany('App\Models\Commercial\Order');
    }

    public function invitations(){
        return $this->hasMany('App\Models\Social\Invitation');
    }

    public function wallet(){
        return $this->hasOne('App\Models\Wallets\Wallet');
    }


}
