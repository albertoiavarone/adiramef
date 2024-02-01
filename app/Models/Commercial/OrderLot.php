<?php

namespace App\Models\Commercial;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Emadadly\LaravelUuid\Uuids;

class OrderLot extends Model
{
  use HasFactory,Uuids;

  protected $guarded = ['id', 'created_at'];

  protected $casts = [
      //
  ];

  public function order(){
      return $this->belongsTo('App\Models\Commercial\Order');
  }

  public function works(){
      return $this->hasMany('App\Models\Production\Work');
  }

}
