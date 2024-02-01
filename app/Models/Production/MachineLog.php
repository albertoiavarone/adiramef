<?php

namespace App\Models\Production;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Emadadly\LaravelUuid\Uuids;

class MachineLog extends Model
{
    use HasFactory,Uuids;

    protected $guarded = ['id', 'created_at'];

    protected $casts = [
        'date' => 'datetime',
        'message' => 'json',
    ];

    public function machine(){
        return $this->belongsTo('App\Models\Production\Machine');
    }
}
