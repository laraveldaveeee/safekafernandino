<?php

use App\Http\Controllers\API\AuthController;
//Users Admin
Route::get('/users', 'API\UsersController@index');
Route::post('/users', 'API\UsersController@store');
Route::get('/users/{user}/edit', 'API\UsersController@edit');
Route::patch('/users/{user}', 'API\UsersController@update');
Route::get('/users/{user}/show', 'API\UsersController@show');
Route::delete('/users/{user}', 'API\UsersController@destroy');


//Sign Up Rescuers
Route::post('/signup', 'API\SignUpRescuersController@signup');

//Pending Rescuer
Route::get('/rescuers-pending', 'API\PendingRescuerController@index');
Route::get('/rescuers-pending/{user}/manage', 'API\PendingRescuerController@manage');
//Rescuer Lists
Route::patch('/rescuers/{user}/approve', 'API\PendingRescuerController@approve');
Route::patch('/rescuers/{user}/decline', 'API\PendingRescuerController@decline');
Route::get('/rescuers', 'API\RescuersController@index');
Route::post('/rescuers', 'API\RescuersController@store');
Route::get('/rescuers/{user}/view', 'API\RescuersController@show');
//Incidents
Route::get('/incidents', 'API\IncidentsController@index');
Route::post('/incidents/{id}/dispatch', 'API\IncidentsController@dispatchIncident');



//Evacuation Points 
Route::get('/evacuation-points', 'API\EvacuationPointsController@index');
Route::get('/evacuation-points/{evacuationPoint}/show', 'API\EvacuationPointsController@show');
Route::post('/evacuation-points', 'API\EvacuationPointsController@store');
Route::delete('/evacuation-points/{id}',  'API\EvacuationPointsController@destroy');

//Children
Route::get('/childrens', 'API\ChildrensController@index');
Route::post('/childrens', 'API\ChildrensController@store');

//Guardian 
Route::get('/guardians', 'API\GuardiansController@index');
Route::post('/guardians', 'API\GuardiansController@store');

//Emergency Types
Route::get('/emergency-types', 'API\EmergencyTypesController@index');
Route::post('/emergency-types', 'API\EmergencyTypesController@store');
Route::delete('/emergency-types/{emergency}', 'API\EmergencyTypesController@destroy');


	Route::get('/incident/rescuers', 'API\IncidentRescuersController@pending'); 

	Route::post('/login', 'API\AuthController@apiLogin');
// Route::middleware('auth:sanctum')->group(function () {
// });