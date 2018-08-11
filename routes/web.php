<?php

Route::group(['middleware' => 'web'],function(){


    Route::get('/','PageController@home');

    Route::get('product/{id}','PageController@product');
    Route::get('product_details/{id}','PageController@productDetails');
    Route::get('contact_us','PageController@contactUs');
    Route::get('about_us','PageController@aboutUs');
    Route::get('photo_gallery','PageController@gallery');
    Route::get('search','PageController@searchProduct');


    /* admin */
    Auth::routes();
    Route::post('register', 'Auth\RegisterController@create');
    Route::get('menu/{id?}',['as'=>'menu.index','uses'=>'ShutiProductController@index']);
    Route::get('create/{id?}',['as'=>'menu.create','uses'=>'ShutiProductController@create']);
    Route::post('menu/store/{id?}',['as'=>'menu.store','uses'=>'ShutiProductController@store']);
    Route::get('menu/{id}/edit',['as'=>'menu.edit','uses'=>'ShutiProductController@edit']);
    Route::post('menu/update/{id}',['as'=>'menu.update','uses'=>'ShutiProductController@update']);
    Route::get('menu/destroy/{id}',['as'=>'menu.destroy','uses'=>'ShutiProductController@destroy']);
    Route::get('menu/change-status/{id}',['as'=>'menu.changeStatus','uses'=>'ShutiProductController@changeStatus']);
    Route::get('product',['as'=>'product.create','uses'=>'ShutiProductController@createProduct']);
    Route::post('product/store',['as'=>'product.productStore','uses'=>'ShutiProductController@productStore']);
    Route::get('product/{id}/edit',['as'=>'product.productEdit','uses'=>'ShutiProductController@editProduct']);
    Route::post('product/update/{id}',['as'=>'product.productUpdate','uses'=>'ShutiProductController@updateProduct']);
    Route::get('product-index',['as'=>'product.index','uses'=>'ShutiProductController@productIndex']);
    Route::get('product/destroy/{id}',['as'=>'product.destroy','uses'=>'ShutiProductController@destroyProduct']);
    Route::get('product-photo-index',['as'=>'productPhoto.index','uses'=>'ShutiProductController@productPhotoIndex']);
    Route::get('product-photo-create/{id}',['as'=>'productPhoto.create','uses'=>'ShutiProductController@createProductPhoto']);
    Route::post('product-photo/store',['as'=>'product.productPhotoStore','uses'=>'ShutiProductController@productPhotoStore']);
    Route::get('product-photo/{id}/edit',['as'=>'product.productPhotoEdit','uses'=>'ShutiProductController@editProductPhoto']);
    Route::post('product-photo/update/{id}',['as'=>'product.productPhotoUpdate','uses'=>'ShutiProductController@updateProductPhoto']);
    Route::get('product-photo/destroy/{id}',['as'=>'product.productPhotoDestroy','uses'=>'ShutiProductController@productPhotoDestroy']);
    Route::get('/admin',['as'=>'adminLogin','uses'=>'ShutiProductController@login']);
    Route::get('/home',['as'=>'adminIndex','uses'=>'ShutiProductController@adminIndex']);
    Route::post('gallery/store',['as'=>'galleryStore','uses'=>'ShutiProductController@galleryStore']);
    Route::get('gallery/{id}/edit',['as'=>'galleryEdit','uses'=>'ShutiProductController@editGallery']);
    Route::post('gallery/update/{id}',['as'=>'galleryUpdate','uses'=>'ShutiProductController@updateGallery']);
    Route::get('gallery-index',['as'=>'gallery.index','uses'=>'ShutiProductController@galleryIndex']);
    Route::get('gallery/destroy/{id}',['as'=>'gallery.destroy','uses'=>'ShutiProductController@destroyGallery']);
    Route::get('gallery-create/{id?}',['as'=>'gallery.create','uses'=>'ShutiProductController@createGallery']);

});

