<?php

namespace App\Models\Production;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Emadadly\LaravelUuid\Uuids;
use Illuminate\Database\Eloquent\SoftDeletes;


class Machine extends Model
{
    use HasFactory,Uuids,SoftDeletes;

    protected $guarded = ['id', 'created_at'];

    protected $casts = [
        'options' => 'json'
    ];

    public function builder(){
        return $this->belongsTo('App\Models\Production\Builder');
    }

    public function type(){
        return $this->belongsTo('App\Models\Production\MachineType','machine_type_id');
    }

    public function provider(){
        return $this->belongsTo('App\Models\Production\Provider');
    }

    public function infos(){
        return $this->hasOne('App\Models\Production\MachineInfo');
    }

    public function telemetry(){
        return $this->HasMany('App\Models\Production\MachineData');
    }

    public function last_position(){
        return $this->telemetry()->orderBy('timestamp', 'Desc')->first();
    }

    public function setLastAddressAttribute(){
        return $this->last_position->address;
    }

    public function getStatusAttribute(){

        if(!$this->last_position()) return [];

        $status_id =  $this->last_position()->status;

        switch( $status_id ){
          case "0 ":
             $status['class'] = 'danger';
             $status['label'] = 'Fermo - Motore spento';
          break;
          case "1 ":
            $status['class'] = 'success';
            $status['label'] = 'In Movimento';
          break;
          case "2 ":
            $status['class'] = 'warning';
            $status['label'] = 'Fermo - Motore accesso';
          break;
        }
        return $status;
    }

    public function works(){
        return $this->hasMany('App\Models\Production\Work');
    }

    public function last_work(){
        return $this->works()->orderBy('date_start','DESC')->limit(1)->first();
    }

    public function machine_orders(){
        return $this->hasMany('App\Models\Commercial\OrderMachine');
    }

    public function syncs(){
        return $this->hasMany('App\Models\Production\MachineSync');
    }

    public function last_sync(){
        return $this->syncs()->where('type','prod')->orderBy('id','DESC')->limit(1)->first();
    }

    public function last_sync_dia(){
        return $this->syncs()->where('type','dia')->orderBy('id','DESC')->limit(1)->first();
    }

    public function logs(){
        return $this->hasMany('App\Models\Production\MachineLog');
    }

    public function last_log(){
        return $this->logs()->orderBy('id','DESC')->limit(1)->first();
    }

    public function schedules(){
        return $this->hasMany('App\Models\Production\Schedule')->orderBy('id','DESC');
    }

    public function manteinances(){
        return $this->hasMany('App\Models\Production\MachineManteinance')->orderBy('id','DESC');
    }

    public function attachments(){
        return $this->HasMany('App\Models\Production\MachineAttachment');
    }

    public function programs(){
        return $this->HasMany('App\Models\Production\Program');
    }

}
