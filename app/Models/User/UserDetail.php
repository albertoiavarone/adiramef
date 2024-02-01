<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Emadadly\LaravelUuid\Uuids;

class UserDetail extends Model
{
    use HasFactory,Uuids;


    protected $guarded  = ['id', 'created_at'];

    public function user(){
        return $this->belongsTo('App\Models\User');
    }

    public function nation(){
        return $this->belongsTo('App\Models\Geo\Nation');
    }

    public function province(){
        return $this->belongsTo('App\Models\Geo\Province');
    }

    public function city(){
        return $this->belongsTo('App\Models\Geo\City');
    }

}
