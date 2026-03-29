<?php

use Illuminate\Support\Facades\Route;
 

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/users', 'UsersController@index')->name('users.index');
Route::get('/incidents', 'IncidentsController@index')->name('incidents.index');
Route::get('/evacuation-points', 'EvacuationPointsController@index')->name('evacuation-points.index');
Route::get('/evacuation-points/{evacuationPoint}/show', 'EvacuationPointsController@show');
 