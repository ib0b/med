<?php

namespace App\Http\Controllers;

use App\Queue;
use App\PatientVisit;
use App\PatientVisitTransaction;
use Illuminate\Http\Request;

class QueueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }
    public function nextPatient(Queue $queue)
    {
        $dep = request('dep');
        //get next patient
        $nextPat = Queue::where('department',$dep)->orderBy('created_at', 'asc')->first();
        //get current visit obj
        $currentVisit = $nextPat->patient->visits()->where('status','insession')->first();
        //remove from queue
        Queue::destroy($nextPat->id);
        return response($currentVisit);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $patID =request('id');
        $dep =request('department');

        if(Queue::where('patient_id',$patID)->where('department', $dep) ->count()!=0){
            //do not queue //already queued
            return;
        }

        $queue = new Queue();
        $queue->department = $dep;
        $queue->patient_id = $patID;
        $queue->save();

        if($queue->patient->visits->where('status','insession')->count()==0){
            $patVisit = new PatientVisit();
            $patVisit->patient_id= request('id');
            $patVisit->status="insession";
            $patVisit->save();
        }


        return response($queue->jsonSerialize());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Queue  $queue
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //
      $dep = request('dep');
      $queuedPatients =  Queue::where('department',$dep)->orderBy('created_at', 'asc')->get();
      $results =[];
      foreach ($queuedPatients as $qp) {
        array_push($results,[
            'id'=> $qp->patient->id,
            'name'=> $qp->patient->name,
            'time'=> $qp->created_at->toDayDateTimeString() ,
        ]);
      }
      return response($results);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Queue  $queue
     * @return \Illuminate\Http\Response
     */
    public function edit(Queue $queue)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Queue  $queue
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Queue $queue)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Queue  $queue
     * @return \Illuminate\Http\Response
     */
    public function destroy(Queue $queue)
    {
        //
    }
}
