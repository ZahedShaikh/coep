<?php

Route::get('/', function () {
    return view('auth.login');
});
Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home');

/*  User Page   
 */
// Update Marks
Route::get('/marks', 'semesterController@edit')->name('marks');
Route::post('/marksupdate', 'semesterController@update')->name('marksupdate');
// Update Bank
Route::get('/banks', 'BankUserController@edit')->name('banks');
Route::post('/bankupdate', 'BankUserController@update')->name('bankupdate');
// Update user Info
Route::get('/updateuserinfo', 'userupdateController@edit')->name('updateuserinfo');
Route::post('/myuserupdate', 'userupdateController@update')->name('myuserupdate');
// Print user profile
Route::get('/profileprint', 'ProfilePrintController@show')->name('profileprint');



/*  Admin Page
 */

//  newApplications
Route::get('/getNewApplications', 'newApplicationsController@index')->name('getNewApplications');
Route::get('/showApplicants', 'newApplicationsController@show')->name('showApplicants');
Route::get('/assignScholarships/', 'newApplicationsController@accept')->name('assignScholarships');
Route::get('/rejectAllNewApplications', 'newApplicationsController@reject')->name('rejectAllNewApplications');

//  Send Sacntion amount to Account department for monry transfer
Route::get('/getSanctionAmount', 'sanctionAmountController@index')->name('getSanctionAmount');
Route::get('/showSanctionAmount', 'sanctionAmountController@show')->name('showSanctionAmount');
Route::get('/sendSanctionAmount/', 'sanctionAmountController@send')->name('sendSanctionAmount');




/*
 *  Temp URL to be remove later
 */
Route::resource('ajax-crud', 'AjaxController');
//https://www.tutsmake.com/laravel-5-7-create-first-ajax-crud-application/
Route::get('/live_search', 'LiveSearch@index')->name('live_search');
Route::get('/live_search/action', 'LiveSearch@action')->name('live_search.action');
//https://www.webslesson.info/2018/04/live-search-in-laravel-using-ajax.html