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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Calendar Views
Route::resource('/calendarPage','AppointmentController');
Route::get('/addEvents', 'AppointmentController@addEventPage');
Route::get('/displayEvent', 'AppointmentController@show');
Route::get('/deleteEvent', 'AppointmentController@show');
Route::post('/shareEvent/{id}', 'AppointmentController@shareEvent');
