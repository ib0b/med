<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PatientVisit extends Model
{
    //
    public function patient()
    {
        return $this->belongsTo('App\Patient');
    }

    public function transactions(){
       return $this->hasMany('App\PatientVisitTransactions');
    }
}
