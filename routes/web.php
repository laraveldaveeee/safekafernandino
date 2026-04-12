<?php

use Illuminate\Support\Facades\Route;
 

Route::get('/', function () {
    return view('welcome');
});
//Testing Signup API
// Route::get('/sign-up', 'SignupController@index');
Auth::routes();  
Route::group(['middleware' => 'auth'], function(){ 
    Route::middleware('role:ADMINISTRATOR')->group(function () {
        Route::get('/home', 'HomeController@index')->name('home');
        Route::get('/users', 'UsersController@index')->name('users.index');
        Route::get('/users/{user}/edit', 'UsersController@edit')->name('users.edit');

        Route::get('/rescuers-pending', 'PendingRescuerController@index')->name('rescuers-pending.index');
        Route::get('/rescuers-pending/{user}/manage', 'PendingRescuerController@manage');

        Route::get('/incidents', 'IncidentsController@index')->name('incidents.index');
        Route::get('/evacuation-points', 'EvacuationPointsController@index')->name('evacuation-points.index');
        Route::get('/evacuation-points/{evacuationPoint}/show', 'EvacuationPointsController@show');

        Route::get('/rescuers' , 'RescuersController@index')->name('rescuers.index');
        Route::get('/rescuers/{user}/view' , 'RescuersController@show');
         
         Route::get('/emergency-types', 'EmergencyTypesController@index')->name('emergency-types.index');


         //Citzens
         Route::get('/citizens-pending', 'CitizensController@pending');
         Route::get('/citizens-pending/{user}/manage', 'CitizensController@manage');
         //Citizens lists of approved
         Route::get('/citizens', 'CitizensController@index');
         Route::get('/citizens/{user}/profile', 'CitizensController@profile');

     });
  });
 

 