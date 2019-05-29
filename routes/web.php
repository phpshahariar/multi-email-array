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

Route::get('/', 'EmailController@index');
Route::post('/sent/email', 'EmailController@sent_email');
Route::post('/sent/customer/mail', 'EmailController@sent_customer_mail');
Route::post('//mail/send', 'EmailController@one_click_mail');
Route::post('sent/customer/sms', 'EmailController@one_click_sms');


Route::post('/save/student', 'EmailController@sent_student_info');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');



Route::get('export', 'ItemController@export')->name('export');
Route::get('importExportView', 'ItemController@importExportView');
Route::post('import', 'ItemController@import')->name('import');



