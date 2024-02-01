<?php

namespace App\Models\Production;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Emadadly\LaravelUuid\Uuids;

class MachineManteinance extends Model
{
  use HasFactory,Uuids;

  protected $guarded = ['id', 'created_at'];

  protected $casts = [

  ];

  public function machine(){
      return $this->belongsTo('App\Models\Production\Machine');
  }

  public function type(){
      return $this->belongsTo('App\Models\Production\MachineManteinanceType','machine_manteinance_type_id');
  }

  public function status(){
      return $this->belongsTo('App\Models\Production\MachineManteinanceStatus','machine_manteinance_status_id');
  }

  public function logs(){
      return $this->hasMany('App\Models\Production\MachineManteinanceLog');
  }


}
