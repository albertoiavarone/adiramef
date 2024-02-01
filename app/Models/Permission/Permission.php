<?php

namespace App\Models\Permission;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Role\Role;
use Spatie\Permission\Traits\HasRoles;


class Permission extends Model
{
    use HasFactory , HasRoles;
    
    protected $fillable = [
        'name',
        'group',
        'description',
        'guard_name'
    ];
    
    
    
    public function roles(){
        return $this->belongsToMany(Role::class, 'role_has_permissions');
    }
}
