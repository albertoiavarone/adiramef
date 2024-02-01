<?php

namespace App\Models\Production;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkDocument extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at'];

    protected $casts = [
        //
    ];

    public function work_productions(){
      return $this->hasMany('App\Models\Production\WorkProduction');
    }

}
