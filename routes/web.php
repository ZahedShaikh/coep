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
 * Route::get('/assignScholarships/{lists_of_students}', 'assignScholarships@show')->name('assignScholarships');
 * Route::get('/amountDistro/{students_COLON_amount}', 'amountDistroController@show')->name('amountDistro');
 * Route::get('/displayStudentDetails/{formNo}', 'displayStudentDetails@show')->name('displayStudentDetails');
 * Route::get('/displayAll/{year}/{college}/{area}', 'displayAllController@show')->name('displayAll');
 */

Route::get('/getScholarships', 'assignScholarshipsController@edit')->name('getScholarships');
Route::post('/assignScholarships', 'assignScholarshipsController@update')->name('assignScholarships');


Route::get('/amountDistro', 'amountDistroController@show')->name('amountDistro');
Route::get('/displayStudentDetails', 'displayStudentDetailsController@show')->name('displayStudentDetails');
Route::get('/displayAll', 'displayAllController@show')->name('displayAll');

//https://stackoverflow.com/questions/34217120/how-to-pass-multiple-arguments-with-url-routing-in-laravel-5-1

