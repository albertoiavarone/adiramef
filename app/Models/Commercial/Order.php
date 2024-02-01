<?php

namespace App\Models\Commercial;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Emadadly\LaravelUuid\Uuids;

class Order extends Model
{
    use HasFactory, Uuids,SoftDeletes;

    protected $guarded = ['id','uuid', 'created_at'];



    public function logs(){
      return $this->hasMany('App\Models\Commercial\OrderLog');
    }

    public function works(){
      return $this->hasMany('App\Models\Production\Work');
    }

    public function documents(){
      return $this->hasMany('App\Models\Commercial\OrderDocument');
    }

    public function order_machines(){
        return $this->hasMany('App\Models\Commercial\OrderMachine');
    }

    public function status(){
      return $this->belongsTo('App\Models\Commercial\OrderStatus', 'order_status_id');
    }

    public function getWorksCountAttribute(){
      return $this->works->count();
    }

    public function getOrderTotalCostAttribute(){
      return $this->works->sum('cost');
    }

    public function getOrderTotalFuelAttribute(){
      return $this->works->sum('fuel');
    }

    public function getOrderTotalEnergyConsumedAttribute(){
      return $this->works->sum('energy_consumed');
    }

    public function lots(){
      return $this->hasMany('App\Models\Commercial\OrderLot');
    }


}
