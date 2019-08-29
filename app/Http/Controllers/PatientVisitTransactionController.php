<?php

namespace App\Http\Controllers;
use App\PatientVisit;
use App\PatientVisitTransaction;
use App\Patient;

use Illuminate\Http\Request;

class PatientVisitTransactionController extends Controller
{
    //
    public function create()
    {
        $visit = PatientVisit::find(request('visitId'));
        $tx = new PatientVisitTransaction();
        $tx->department= request('department');
        $tx->practitioner= auth()->user()->name;
        $tx->patient_visit_id= $visit->id;
        $tx->notes = request('notes');
        $tx->patient_id = $visit->patient->id;
        $tx->save();

    }
    public function search()
    {
      $query = request('searchQuery');
      $results =[];
      $patients =  Patient::where('name','like','%'.$query.'%')->get();
      foreach ($patients as $patient) {
          $transactions = $patient->transactions;
          foreach ($transactions as $tx) {
             array_push($results,[
              'time'=>$tx->created_at->toDayDateTimeString(),
              'practitioner'=>$tx->practitioner,
              'department'=>$tx->department,
              'patient'=>$patient->name
             ]);
          }
      }
      return response($results);
    }
}
