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
    return view('welcome');
});

Auth::routes();

Route::group(['middleware' => 'auth'], function(){
    
//route outlets

Route::delete('/outlets/{outlet}/delete', 'OutletController@deletePermanent')->name('outlets.deletepermanent'); 

Route::resource("outlets", "OutletController");

//route member

Route::delete('/members/{outlet}/delete', 'MemberController@deletePermanent')->name('members.deletepermanent'); 

Route::resource("members", "MemberController");

//route transaksi

Route::get('/transaksis/trash', 'TransaksiController@trash')->name('transaksis.trash'); 

Route::get('/transaksis/{id}/restore', 'TransaksiController@restore')->name('transaksis.restore'); 

Route::delete('/transaksis/{outlet}/delete', 'TransaksiController@deletePermanent')->name('transaksis.deletepermanent'); 

Route::resource("transaksis", "TransaksiController");

//route paket
Route::get('/pakets/trash', 'PaketController@trash')->name('pakets.trash'); 

Route::get('/pakets/{id}/restore', 'PaketController@restore')->name('pakets.restore'); 

Route::delete('/pakets/{outlet}/delete', 'PaketController@deletePermanent')->name('pakets.deletepermanent'); 

Route::resource("pakets", "PaketController");

Route::get('/ajax/outlets/search', 'OutletsController@ajaxSearch');


Route::resource("users", "UserController");

Route::get('/ajax/users/search', 'UserController@ajaxSearch');

Route::get('/home', 'HomeController@index')->name('home');
 
});