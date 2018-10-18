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
Route::group(['prefix'=>'admin','namespace'=>'Admin','middleware'=>'auth'],function(){
	include('admin/category.php');
	include('admin/partners.php');
	include('admin/product.php');
	include('admin/account.php');
});
// Route login admin
Route::get('admin/login.html','Admin\AdminController@login')->name('login');
Route::post('admin/login.html','Admin\AdminController@post_login')->name('login');

// Route logout admin
Route::get('admin/logout','Admin\AdminController@logout')->name('logout');
// Route::get('/', function () {
//     return view('welcome');
// });
