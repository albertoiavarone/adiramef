<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuthOtp extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at'];

    
}
