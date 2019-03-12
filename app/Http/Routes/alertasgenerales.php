<?php
Route::post('/users/permissions', array('uses' => 'AlertasGeneralesControler@PermisionsManipulation', 'as' => 'permissionsman'));
Route::get('/setting/alertasgenerales', array('uses' => 'AlertasGeneralesControler@Index', 'as' => 'alertasgenerales'));
Route::get('/setting/getalertasgenerales', array('uses' => 'AlertasGeneralesControler@GetAlertasGenerales', 'as' => 'getalertasgenerales'));
Route::get('/setting/alertasgenerales/edit/{id}', array('uses' => 'AlertasGeneralesControler@Edit', 'as' => 'alertasgeneralesedit'));
Route::post('/setting/alertasgenerales/createorupdate', array('uses' => 'AlertasGeneralesControler@CreateOrUpdate', 'as' => 'alertasgeneralescreateorupdate'));
