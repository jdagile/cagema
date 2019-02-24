<?php
Route::post('/users/permissions', array('uses' => 'RegionesEstacionesControler@PermisionsManipulation', 'as' => 'permissionsman'));
Route::get('/setting/regionesestaciones', array('uses' => 'RegionesEstacionesControler@Index', 'as' => 'regionesestaciones'));
Route::get('/setting/getregionesestaciones', array('uses' => 'RegionesEstacionesControler@GetRegionesEstaciones', 'as' => 'getregionesestaciones'));
Route::get('/setting/regionesestaciones/edit/{id}', array('uses' => 'RegionesEstacionesControler@Edit', 'as' => 'regionesestacionesedit'));
Route::post('/setting/regionesestaciones/createorupdate', array('uses' => 'RegionesEstacionesControler@CreateOrUpdate', 'as' => 'regionesestacioncreateorupdate'));
