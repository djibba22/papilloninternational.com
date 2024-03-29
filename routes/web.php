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

Route::get('/', function () {
    $tours = PapillonInternational\Tours::all();

    return view('welcome', compact('tours'));
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});

Route::get('/tours/{tour}', function ($id) {
    $tour = PapillonInternational\Tours::find($id);

    return view('tours.show', compact('tour'));
});

Route::get('/tours/{tour}/register', function ($id) {
    $tour = PapillonInternational\Tours::find($id);
    $user = Auth::user();

    return view('tours.register', compact('tour', 'user'));
});

Route::post('/user/{id}', 'RegistrationController@update');

Route::get('/payment', 'PaymentController@index')->name('payment.index');
Route::post('/payment', 'PaymentController@store')->name('payment.store');