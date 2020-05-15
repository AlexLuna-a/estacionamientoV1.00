<?php

use Illuminate\Support\Facades\Route;

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
    return view('pruebas');
});

/*
Route::get('/', function () {
    return view('pruebas');
})->name('pruebas');

//Route::resource('usr', 'UsuarioController');
*/
Route::get('/','usuarioController@index');
Route::group(['prefix'=>'usr'],function(){
    Route::get('log','usuarioController@loggin');
    Route::post('logIn','usuarioController@loggin_in');
    Route::get('reg','usuarioController@reg');
    Route::get('loggOut','usuarioController@loggout');
    Route::get('edit','usuarioController@edit');
    Route::post('in','usuarioController@reg_in');
    
    
    
});
/*aaaaaaaaaaaa;*/
/*aaaaaaaaaaaa;*/



Route::group(['prefix'=>'est'],function(){
    Route::get('/', 'estacionamientoController@index');
    Route::get('show/{id}', 'estacionamientoController@show');
    Route::get('edit/{id}', 'estacionamientoController@edit');
    Route::post('store', 'estacionamientoController@store');
    Route::get('create', 'estacionamientoController@create');
    Route::post('save', 'estacionamientoController@save');
});

Route::group(['prefix'=>'mvt'],function(){
    Route::get('/', 'movimientoController@index');
    Route::get('show/{id}', 'movimientoController@show');
    Route::get('edit/{id}', 'movimientoController@edit');
    Route::post('store', 'movimientoController@store');
    Route::get('create', 'movimientoController@create');
    Route::post('save', 'movimientoController@save');
});







//Route::resource('typ', 'tipoUsuarioController');

Route::group(['prefix'=>'typ'],function(){
    Route::get('exa','tipoUsuarioController@tuMama');
    
});

