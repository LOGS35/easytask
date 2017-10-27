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

Route::get('welcome', function () {
    return view('welcome');
});

/*Route::get('home', function () {
    return view('home');
});*/

/*Route::get('/', function () {
    return view('users.login');
});
*/
/*Route::get('register', function () {
    return view('login.register');
});*/

/*Route::group(['prefix' => '/'], function(){
    Route::resource('users','UsersController');
});*/

/*Route::get('/', function () {
    return view('layout');
});*/
Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function(){
    Route::resource('profile','ProfileController');
});

Route::group(['middleware' => 'auth'], function(){
    Route::resource('equip','EquipController');
    Route::get('equip/{id}/destroy', [
        'uses' => 'EquipController@destroy',
        'as' => 'equip.destroy'
    ]);
});

Route::group(['middleware' => 'auth'], function(){
    Route::resource('users','UsersController');
    Route::get('users/{id}/destroy', [
        'uses' => 'UsersController@destroy',
        'as' => 'users.destroy'
    ]);
});

Route::get('/user/find', 'UsersController@find');

Route::get('obteneruser', 'Eloquent\ObjectResponseController@datauser');
Route::get('obtenerequipo', 'Eloquent\ObjectResponseController@dataequipo');
