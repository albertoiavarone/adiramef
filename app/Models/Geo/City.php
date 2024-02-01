<?php

namespace App\Models\Geo;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function nation(){
        return $this->belongsTo('App\Models\Geo\Nation');
    }

    public function province(){
        return $this->belongsTo('App\Models\Geo\Province');
    }

}
