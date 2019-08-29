<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PatientVisitTransaction extends Model
{
    //
    public function visit()
    {
        return $this->belongsTo('App\PatientVisit');
    }
}
