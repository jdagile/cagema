<?php
Route::post('/users/permissions', array('uses' => 'RegionControler@PermisionsManipulation', 'as' => 'permissionsman'));
Route::get('/setting/regiones', array('uses' => 'RegionControler@Index', 'as' => 'regiones'));
Route::get('/setting/getregiones', array('uses' => 'RegionControler@GetRegiones', 'as' => 'getregiones'));
Route::get('/setting/regiones/edit/{id}', array('uses' => 'RegionControler@Edit', 'as' => 'regionesedit'));
Route::post('/setting/regiones/createorupdate', array('uses' => 'RegionControler@CreateOrUpdate', 'as' => 'regionescreateorupdate'));
