<?php

namespace App\Models\Production;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkProduction extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at'];

    protected $casts = [
        //
    ];

    public function work(){
        return $this->belongsTo('App\Models\Production\Work');
    }

    public function work_document(){
        return $this->belongsTo('App\Models\Production\WorkDocument');
    }
}
