<?php 
Route::get('product', 'ProductController@myPost')->name('product');
Route::get('product/edit/{id}', 'ProductController@edit')->name('product_edit');
<<<<<<< HEAD
Route::get('product/trash', 'ProductController@trash')->name('trash');
Route::get('product/undo/{id}', 'ProductController@undo')->name('undo');
Route::get('product/delete-pro/{id}', 'ProductController@deletePro')->name('deletePro');
=======
>>>>>>> 210b3751eabcf488de0c6345936acdf8eb2baf02
Route::resource('post','ProductController');

// Route::get('/product','ProductController@product')->name('product');
// Route::post('/add-product','ProductController@addProduct')->name('addProduct');
 ?>