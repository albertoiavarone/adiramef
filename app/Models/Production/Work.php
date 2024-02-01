<?php

namespace App\Models\Production;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Emadadly\LaravelUuid\Uuids;
use Illuminate\Database\Eloquent\SoftDeletes;

class Work extends Model
{
    use HasFactory,Uuids,SoftDeletes;

    protected $guarded = ['id', 'created_at'];

    protected $casts = [
        'date_start' => 'datetime',
        'date_stop' => 'datetime',
        'info' => 'json',
    ];

    public function machine(){
        return $this->belongsTo('App\Models\Production\Machine');
    }

    public function order(){
        return $this->belongsTo('App\Models\Commercial\Order');
    }

    public function program(){
        return $this->belongsTo('App\Models\Production\Program');
    }

    public function lot(){
        return $this->belongsTo('App\Models\Commercial\OrderLot', 'order_lot_id');
    }

    public function work_productions(){
        return $this->hasMany('App\Models\Production\WorkProduction')->orderBy('docmagrig_nriga');
    }


}
