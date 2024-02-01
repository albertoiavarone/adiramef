<?php

namespace App\Models\Commercial;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderMachine extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at'];

    public function order(){
        return $this->belongsTo('App\Models\Commercial\Order');
    }

    public function machine(){
        return $this->belongsTo('App\Models\Production\Machine');
    }
}
