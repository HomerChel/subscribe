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

Route::get('/', 'SendMailController@form');
Route::post('/', 'SendMailController@sendEmail');

Route::get('/mail_statistics', 'StatisticsController@mail_statistics');
Route::get('/pages_statistics', 'StatisticsController@pages_statistics');

Route::get('/target/{number}', ['uses' => 'TargetController@target'])->where('number', '[1-3]');
