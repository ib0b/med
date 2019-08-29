<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('app');
// });
Auth::routes();
Route::get('/', 'HomeController@index')->name('department');
Route::group(['middleware' => ['auth','web']], function () {
    Route::get('getDepartment', 'HomeController@getDep');
    Route::resource('patient', 'PatientController');
    Route::post('queue', 'QueueController@store');
    Route::post('getDepartment', 'HomeController@getDep');

    Route::post('patientvisit/patient', 'PatientVisitController@getPatient');
    Route::post('patientvisit/get', 'PatientVisitController@getVisit');
    Route::post('patientvisit/end', 'PatientVisitController@endVisit');

    Route::post('patientVisitTransaction/search', 'PatientVisitTransactionController@search');
    Route::post('patientVisitTransaction/create', 'PatientVisitTransactionController@create');
    Route::post('patientVisitTransaction/report', 'PatientVisitTransactionController@report');

    Route::get('queue/{dep}', 'QueueController@show');
    Route::get('queue/{dep}/next', 'QueueController@nextPatient');
    Route::post('/patient/search', 'PatientController@search');

});



Route::middleware(['auth','web'])->get('/{any}', 'SinglePageController@index')->where('any', '.*');


