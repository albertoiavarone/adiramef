<?php

namespace App\Models\Role;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasPermissions;
use App\Models\Permission\Permission;

class Role extends Model
{
    use HasFactory,HasPermissions;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'guard_name','default'
    ];

    public function permissions(){
        return $this->belongsToMany(Permission::class, 'role_has_permissions');
    }
    
    public function scopeDefault($query){
        return $query->where('default',1);
    }
    
    public function scopeRegister($query){
        return $query->where('on_register',1);
    }
}
