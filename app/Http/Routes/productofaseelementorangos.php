<?php
Route::post('/users/permissions', array('uses' => 'ProductoFaseElementoRangoControler@PermisionsManipulation', 'as' => 'permissionsman'));
Route::get('/setting/productofaseelementorangos', array('uses' => 'ProductoFaseElementoRangoControler@Index', 'as' => 'productofaseelementorangos'));
Route::get('/setting/getproductofaseelementorangos', array('uses' => 'ProductoFaseElementoRangoControler@GetProductoFaseElementoRangos', 'as' => 'getproductofaseelementorangos'));
Route::get('/setting/productofaseelementorangos/edit/{id}', array('uses' => 'ProductoFaseElementoRangoControler@Edit', 'as' => 'productofaseelementorangosedit'));
Route::post('/setting/productofaseelementorangos/createorupdate', array('uses' => 'ProductoFaseElementoRangoControler@CreateOrUpdate', 'as' => 'productofaseelementorangocreateorupdate'));
