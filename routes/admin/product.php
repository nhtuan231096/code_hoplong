<?php 
Route::get('product', 'ProductController@myPost')->name('product');
Route::resource('post','ProductController');

// Route::get('/product','ProductController@product')->name('product');
// Route::post('/add-product','ProductController@addProduct')->name('addProduct');
 ?>