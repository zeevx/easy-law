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

Route::group(['middleware' => 'auth'], function (){
    Route::get('get_field_by_form_name', 'CustomFieldController@get_field_by_form_name')->name('get_field_by_form_name');
    Route::get('get_field_by_form_name_and_form_id', 'CustomFieldController@get_field_by_form_name_and_form_id')->name('get_field_by_form_name_and_form_id');
    Route::resource('custom_fields', 'CustomFieldController');
});
