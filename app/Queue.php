<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Queue extends Model
{
    //
    public function patient()
    {
        return $this->belongsTo('App\Patient');
    }
}
