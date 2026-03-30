<?php

use App\Http\Controllers\API\AuthController;

Route::get('/users', 'API\UsersController@index');
Route::post('/users', 'API\UsersController@store');
Route::get('/users/{user}', 'API\UsersController@edit');
Route::patch('/users/{user}', 'API\UsersController@update');
Route::get('/users/{user}/show', 'API\UsersController@show');
Route::delete('/users/{user}', 'API\UsersController@destroy');

//Pending Rescuer
Route::get('/rescuers-pending', 'API\PendingRescuerController@index');
Route::get('/rescuers-pending/{rescuer}/manage', 'API\PendingRescuerController@manage');

Route::patch('/rescuers/{rescuer}/approve', 'API\PendingRescuerController@approve');
Route::patch('/rescuers/{rescuer}/decline', 'API\PendingRescuerController@decline');


Route::get('/rescuers', 'API\RescuersController@index');
Route::get('/rescuers/{rescuer}/view', 'API\RescuersController@show');

//Incidents

Route::get('/incidents', 'API\IncidentsController@index');

//Evacuation Points 
Route::get('/evacuation-points', 'API\EvacuationPointsController@index');
Route::get('/evacuation-points/{evacuationPoint}/show', 'API\EvacuationPointsController@show');
Route::post('/evacuation-points', 'API\EvacuationPointsController@store');

//Children
Route::get('/childrens', 'API\ChildrensController@index');

//Parent 
Route::get('/parents', 'API\GuardiansController@index');

// Route::middleware('auth:sanctum')->group(function () {
// });