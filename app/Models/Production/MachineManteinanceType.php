<?php

namespace App\Models\Production;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MachineManteinanceType extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at'];

    protected $casts = [

    ];

    public function manteinances(){
        return $this->hasMany('App\Models\Production\MachineManteinance')->orderBy('id','DESC');
    }


}
