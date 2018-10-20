<?php 
Route::resource('posts','ProductController');
Route::post('posts/changeStatus', array('as' => 'changeStatus', 'uses' => 'ProductController@changeStatus'));

Route::get('/product','ProductController@product')->name('product');
// Route::post('/add-product','ProductController@addProduct')->name('addProduct');
 ?>