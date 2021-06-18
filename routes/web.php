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

Auth::routes();

// ADD GET ROUTE FOR PASSWORD/EMAIL MANUALLY
Route::get('password/email', 'App\Http\Controllers\Auth\ForgotPasswordController@showLinkRequestForm');

// TO SHOW REFERRER'S INFO USING THE LINK
Route::get('register/{uname}', 'App\Http\Controllers\Auth\RegisterController@showRegistrationForm');

Route::get('/', function () {
    return view('pages.index');
});

// ADMIN
Route::get('admin', 'App\Http\Controllers\AdminController@show')->name('admin');
Route::post('admin/activate', 'App\Http\Controllers\AdminController@activate')->name('activate');

// DASHBOARD
Route::get('home', 'App\Http\Controllers\HomeController@index')->name('home');

// AFFILIATE
Route::get('affiliates', 'App\Http\Controllers\AffiliateController@show')->name('affiliates');

// BINARY
Route::get('binary', 'App\Http\Controllers\BinaryController@show')->name('binary');
Route::get('binary/{id}', 'App\Http\Controllers\BinaryController@show')->name('binary-user');
Route::post('binary/add', 'App\Http\Controllers\BinaryController@add')->name('binary-add');

// ACCOUNT
Route::get('profile', 'App\Http\Controllers\AccountController@profile')->name('profile');
Route::get('payout', 'App\Http\Controllers\AccountController@payout')->name('payout');
Route::get('security', 'App\Http\Controllers\AccountController@security')->name('security');

// UPLOAD OF PROFILE PICTURE
Route::post('profile/upload', 'App\Http\Controllers\AccountController@uploadProfilePicture')->name('uploadProfilePicture');

// UPDATE OF PROFILE INFORMATION
Route::post('profile/update', 'App\Http\Controllers\AccountController@update')->name('profileUpdate');

// ADDING PAYOUT OPTION
Route::post('payout/add', 'App\Http\Controllers\AccountController@addPayout')->name('addPayout');

// DELETING PAYOUT OPTION
Route::post('payout/delete', 'App\Http\Controllers\AccountController@deletePayout')->name('deletePayout');

// REQUEST PAYOUT
Route::post('payout/request', 'App\Http\Controllers\AccountController@requestPayout')->name('requestPayout');

// CHANGE PASSWORD
Route::post('security/update', 'App\Http\Controllers\AccountController@changePassword')->name('changePassword');

