<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Transaction extends Eloquent
{
    use HasFactory;
    protected $guarded = ['id'];

    public function vehicle(){
        return $this->belongsTo('App\Models\Vehicle','vehicle_id','_id');
    }
}
