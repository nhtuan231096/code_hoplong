<?php 
Route::get('product', 'ProductController@myPost')->name('product');
Route::get('product/edit/{id}', 'ProductController@edit')->name('product_edit');
Route::get('product/trash', 'ProductController@trash')->name('trash');
Route::get('product/undo/{id}', 'ProductController@undo')->name('undo');
Route::get('product/delete-pro/{id}', 'ProductController@deletePro')->name('deletePro');
Route::resource('post','ProductController');

// Route::get('/product','ProductController@product')->name('product');
// Route::post('/add-product','ProductController@addProduct')->name('addProduct');
 ?>