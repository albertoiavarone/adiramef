<?php

namespace App\Models\Commercial;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Emadadly\LaravelUuid\Uuids;

class OrderDocument extends Model
{
  use HasFactory, Uuids,SoftDeletes;

  protected $guarded = ['id', 'created_at'];

  public function order(){
      return $this->belongsTo('App\Models\Commercial\Order');
  }

}
