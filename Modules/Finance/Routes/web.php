<?php

Route::group(['middleware' => ['auth', 'permission']], function(){
    Route::resource('vendors', 'VendorController');
    Route::resource('services', 'ServiceController');
    Route::resource('income_types', 'IncomeTypeController');
    Route::resource('expense_types', 'ExpenseTypeController');

    Route::resource('bank_accounts', "BankAccountController");
    Route::resource('taxes', "TaxController");
    Route::resource('incomes', "IncomeController");
    Route::resource('expenses', "ExpenseController");

    Route::group(['prefix' => 'invoice', 'as' => 'invoice.'], function (){

        Route::get('settings', 'InvoiceController@settings')->name('settings');
        Route::post('settings', 'InvoiceController@post_settings');

        Route::get('print/{invoice}', 'InvoiceController@print')->name('print');
        Route::get('payment/{invoice}/add', 'InvoiceController@add_payment')->name('payment.add');
        Route::post('payment/{invoice}/add', 'InvoiceController@post_add_payment');
        Route::get('payment/{invoice}/show', 'InvoiceController@print')->name('payment.show');

        Route::resource('incomes', 'IncomeInvoiceController');
        Route::resource('expenses', 'ExpenseInvoiceController');

    });

    Route::group(['prefix' => 'report', 'as' => 'report.'], function (){
        Route::get('profit', 'ReportController@profit')->name('profit');
        Route::get('transaction', 'ReportController@transaction')->name('transaction');
        Route::get('statement', 'ReportController@statement')->name('statement');
        Route::get('bank-report/{id}', 'ReportController@bankStatement')->name('bank.statement');

    });



});

Route::group(['prefix' => 'invoice', 'as' => 'invoice.', 'middleware' => 'auth'], function (){
    Route::get('case', 'InvoiceController@getCase')->name('case');
    Route::get('service', 'InvoiceController@getService')->name('service');
});
