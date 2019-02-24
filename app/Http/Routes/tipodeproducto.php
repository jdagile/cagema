<?php
Route::post('/users/permissions', array('uses' => 'TipoDeProductoControler@PermisionsManipulation', 'as' => 'permissionsman'));
Route::get('/setting/tipodeproducto', array('uses' => 'TipoDeProductoControler@Index', 'as' => 'tipodeproducto'));
Route::get('/setting/gettipodeproducto', array('uses' => 'TipoDeProductoControler@GetTipoDeProducto', 'as' => 'gettipodeproducto'));
Route::get('/setting/tipodeproducto/edit/{id}', array('uses' => 'TipoDeProductoControler@Edit', 'as' => 'tipodeproductoedit'));
Route::post('/setting/tipodeproducto/createorupdate', array('uses' => 'TipoDeProductoControler@CreateOrUpdate', 'as' => 'tipodeproductocreateorupdate'));
