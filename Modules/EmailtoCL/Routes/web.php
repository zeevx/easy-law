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



use Illuminate\Support\Facades\Route;

Route::prefix('send_email_to_court')->group(function() {
    Route::get('/{case}', 'EmailtoCLController@sendMailToCourt')->name('send_email_to_court');
    Route::get('/{case}/{lawyer}', 'EmailtoCLController@sendMailToLawyer')->name('send_email_to_lawyer');
});
