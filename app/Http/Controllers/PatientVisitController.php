<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PatientVisit;
use App\Patient;
use App\Queue;
class PatientVisitController extends Controller
{
    //
    public function getPatient()
    {
        $patient = PatientVisit::find(request('id'))->patient;
        return response($patient);
    }
    public function endVisit()
    {
        $visit = PatientVisit::find(request('visitId'));
        $visit->status="completed";
        $visit->save();
        //clear all queues just incase
        Queue::where('patient_id',$visit->id)->delete();

    }
    public function getVisit()
    {
        $patient = Patient::find(request('id'));
        return response(array($patient->visits,$patient));
        //clear all queues just incase

    }
}
