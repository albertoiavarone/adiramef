<?php

namespace App\Models\Production;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Emadadly\LaravelUuid\Uuids;

class Builder extends Model
{

    use HasFactory,Uuids;

    protected $guarded = ['id', 'created_at'];

    protected $casts = [
        //
    ];

    public function machines(){
        return $this->hasMany('App\Models\Production\Machine');
    }

}
