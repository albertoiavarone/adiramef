<?php

namespace App\Models\Production;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Emadadly\LaravelUuid\Uuids;
use Illuminate\Database\Eloquent\SoftDeletes;

class Provider extends Model
{
  use HasFactory,Uuids,SoftDeletes;

  protected $guarded = ['id', 'created_at'];

  protected $casts = [
      'options' => 'json'
  ];

  public function machines(){
      return $this->hasMany('App\Models\Production\Machine');
  }
}
