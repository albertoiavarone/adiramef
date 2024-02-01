<?php

namespace App\Models\Commercial;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Emadadly\LaravelUuid\Uuids;

class OrderLog extends Model
{
    use HasFactory,Uuids;

    protected $guarded = ['id','uuid', 'created_at'];

    public function order(){
      return $this->belongsTo('App\Models\Commercial\Order');
    }

    public function user(){
      return $this->belongsTo('App\Models\User');
    }

    public function status(){
      return $this->belongsTo('App\Models\Commercial\OrderStatus', 'order_status_id');
    }

}
