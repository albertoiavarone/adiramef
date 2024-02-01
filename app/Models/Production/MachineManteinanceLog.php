<?php

namespace App\Models\Production;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Emadadly\LaravelUuid\Uuids;

class MachineManteinanceLog extends Model
{
  use HasFactory,Uuids;

  protected $guarded = ['id', 'created_at'];

  protected $casts = [

  ];

  public function manteinance(){
      return $this->belongsTo('App\Models\Production\MachineManteinance');
  }

  public function status(){
      return $this->belongsTo('App\Models\Production\MachineManteinanceStatus','machine_manteinance_status_id');
  }

  public function user(){
      return $this->belongsTo('App\Models\User');
  }

}
