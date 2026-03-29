<?php

use App\Http\Controllers\API\AuthController;

Route::get('/users', 'API\UsersController@index');
Route::post('/users', 'API\UsersController@store');
Route::get('/users/{user}', 'API\UsersController@edit');
Route::patch('/users/{user}', 'API\UsersController@update');
Route::get('/users/{user}/show', 'API\UsersController@show');
Route::delete('/users/{user}', 'API\UsersController@destroy');

//Incidents

Route::get('/incidents', 'API\IncidentsController@index');

//Evacuation Points 
Route::get('/evacuation-points', 'API\EvacuationPointsController@index');
Route::get('/evacuation-points/{evacuationPoint}/show', 'API\EvacuationPointsController@show');
Route::post('/evacuation-points', 'API\EvacuationPointsController@store');

//Children
Route::get('/childrens', 'API\ChildrensController@index');

// Route::middleware('auth:sanctum')->group(function () {
// });