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
//Done
Route::get('/getScholarships', 'assignScholarshipsController@edit')->name('getScholarships');
Route::post('/assignScholarships', 'assignScholarshipsController@update')->name('assignScholarships');
Route::get('/amountDistro', 'transactionhistoryController@edit')->name('getamountDistro');
Route::post('/assignamountDistro', 'transactionhistoryController@update')->name('assignamountDistro');

// Wrokaround
Route::get('/getStudentDataView', 'AllStudentDataViewController@ajaxRequest')->name('getStudentDataView');
Route::get('/allStudentDataView', 'AllStudentDataViewController@index')->name('allStudentDataView');
//Route::resource('allStudentDataView', 'AllStudentDataViewController');

// Later to be done, if needed!
Route::get('/displayAStudentDetail', 'displayAStudentDetailController@show')->name('displayAStudentDetail');
//Route::get('/displayAll', 'displayAllController@show')->name('displayAll');

//https://stackoverflow.com/questions/34217120/how-to-pass-multiple-arguments-with-url-routing-in-laravel-5-1
