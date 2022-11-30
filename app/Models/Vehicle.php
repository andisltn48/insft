<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Vehicle extends Eloquent
{
    use HasFactory;
    protected $guarded = ['id'];

    public function motorcycle(){
        return $this->belongsTo('App\Models\Motorcycle','id','vehicle_id');
    }
}
