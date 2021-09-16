<?php

use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;

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


Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

Route::get('/forgot-password', [PasswordResetLinkController::class, 'create'])
                ->middleware('guest')
                ->name('password.request');

Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])
                ->middleware('guest')
                ->name('password.email');

Route::get('/reset-password/{token}', [NewPasswordController::class, 'create'])
                ->middleware('guest')
                ->name('password.reset');

Route::post('/reset-password', [NewPasswordController::class, 'store'])
                ->middleware('guest')
                ->name('password.update');

Route::get('/', function(){
	return redirect()->route('home');
});


Route::middleware('permission')->prefix('hr')->group(function(){
	Route::resource('staffs', 'StaffController')->except('destroy');
	Route::post('/staff-status-update', 'StaffController@status_update')->name('staffs.update_active_status');
	Route::get('/staff/view/{id}', 'StaffController@show')->name('staffs.view');
	Route::get('/staff/report-print/{id}', 'StaffController@report_print')->name('staffs.report_print');
	Route::get('/staff/destroy/{id}', 'StaffController@destroy')->name('staffs.destroy');
});


Route::post('/staff-document/store', 'StaffController@document_store')->name('staff_document.store');
Route::get('/staff-document/destroy/{id}', 'StaffController@document_destroy')->name('staff_document.destroy');
Route::get('/profile-view', 'StaffController@profile_view')->name('profile_view');
Route::post('/profile-edit', 'StaffController@profile_edit')->name('profile_edit_modal');
Route::post('/profile-update/{id}', 'StaffController@profile_update')->name('profile.update');





Route::group(['middleware' => 'auth'], function () {
	Route::get('/home', 'HomeController@index')->name('home');

	Route::any('case/category/change/{id}', 'CaseController@category_change')->name('case.category.change');
	Route::any('case/category/store', 'CaseController@category_store')->name('case.category.store');

	Route::any('case/court/change/{id}', 'CaseController@court_change')->name('case.court.change');
	Route::any('case/court/store', 'CaseController@court_store')->name('case.court.store');

	Route::get('my-profile','StaffController@profile_view')->name('my-profile');
    Route::get('add-lawyer/{case}', 'CaseController@add_lawyer')->name('case.add_lawyer');
    Route::post('add-lawyer/{case}', 'CaseController@post_lawyer');
    Route::delete('remove-lawyer/{case}/{lawyer}', 'CaseController@remove_lawyer')->name('case.remove_lawyer');

	Route::group(['middleware' => 'permission'],function(){

		Route::group(['prefix' => 'master', 'as' => 'master.', 'namespace' => 'Master'], function () {
			Route::resource('stage', 'StageController');
			Route::resource('act', 'ActController');
			Route::resource('court', 'CourtController');
		});


		Route::group(['prefix' => 'category', 'as' => 'category.', 'namespace' => 'Category'], function () {
			Route::resource('court', 'CourtController');
			Route::resource('case', 'CaseController');
			Route::resource('client', 'ClientController');
			Route::resource('contact', 'ContactController');
		});




		Route::resource('lawyer', 'LawyerController');

		Route::resource('contact', 'ContactController');

		Route::resource('client', 'ClientController');
		Route::get('case/filter', 'CaseController@filter')->name('case.filter');


		Route::resource('case', 'CaseController');

        Route::get('date/send_mail', 'HearingDateController@send_mail')->name('date.send_mail');
        Route::post('date/send_mail', 'HearingDateController@post_send_mail');
		Route::resource('date', 'HearingDateController');
		Route::resource('putlist', 'PutlistController');
		Route::resource('lobbying', 'LobbyingController');


		Route::any('judgement/reopen', 'JudgementController@reopen')->name('judgement.reopen');
		Route::any('judgement/close', 'JudgementController@close')->name('judgement.close');

		Route::get('/causelist', 'CaseController@causelist')->name('causelist.index');

		Route::any('closed', 'JudgementController@closed')->name('judgement.closed');

		Route::resource('judgement', 'JudgementController');

		Route::resource('appointment', 'AppointmentController');

        Route::any('judgement/reopen/store', 'JudgementController@reopen_store')->name('judgement.reopen_store');
        Route::any('judgement/close/store', 'JudgementController@close_store')->name('judgement.close_store');


        Route::get('/updateSystem', 'UpdateController@updatesystem')->name('setting.updatesystem');
        Route::post('/updateSystem', 'UpdateController@updatesystemsubmit')->name('setting.updateSystem.submit1');

        Route::group(['prefix' => 'setup', 'as' => 'setup.' ], function (){
            Route::resource('country', 'CountryController');
            Route::resource('state', 'StateController');
            Route::resource('city', 'CityController');
        });

	});



    Route::get('/change-password', 'HomeController@change_password')->name('change_password');
    Route::post('/change-password', 'HomeController@post_change_password');

    Route::post('/search', 'SearchController@search')->name('search');

    Route::resource('file', 'FileController');

});


Route::any('date-reminder-corn', 'DateRemainderController@dueDate')->name('date-reminder');

Route::group(['as' => 'select.', 'prefix' => 'select'], function () {
	Route::get('/division', 'Api\SelectController@division')->name('division');
	Route::post('/state', 'Api\SelectController@state')->name('state');
	Route::post('/city', 'Api\SelectController@city')->name('city');
	Route::post('/court', 'Api\SelectController@court')->name('court');
});



Route::get('/js/lang/js', function () {

//    if (\App::environment('local')) {
    \Cache::forget('jslang.js');
//    }

    if (\Cache::has('locale')) {
        config(['app.locale' => \Cache::get('locale')]);
    }

    $strings = Cache::rememberForever('jslang.js', function () {
        $lang = config('app.locale');

        $file   = resource_path('lang/' . $lang . '/js.php');
        $strings = [];
        if (\Illuminate\Support\Facades\File::exists($file)){
            $name           = basename($file, '.php');
            $strings[$name] = require $file;
        }

//        Remove this if block if you dont need to load language insides module

        if(class_exists(\Nwidart\Modules\Module::class)){
            $modules = \Module::all();
            $module_files = [];
            foreach ($modules as $module) {
                if ($module->isEnabled()) {
                    $file = module_path($module->getName()) . '/Resources/lang/'.$lang.'/js.php';
                    if (\Illuminate\Support\Facades\File::exists($file)) {
                        $module_files[$module->getLowerName()] = $file;
                    }
                }
            }

            foreach ($module_files as $module => $file) {
                $name           = basename($file, '.php');
                $strings[$module.'::'.$name] = require $file;

            }
        }

        return $strings;
    });
    header('Content-Type: text/javascript');
    echo('window.jsi18n = ' . json_encode($strings) . ';');
    exit();
})->name('assets.lang.js');


// require __DIR__.'/auth.php';


