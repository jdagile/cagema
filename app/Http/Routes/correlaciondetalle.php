<?php
Route::post('/users/permissions', array('uses' => 'CorrelacionDetalleControler@PermisionsManipulation', 'as' => 'permissionsman'));
Route::get('/setting/correlaciondetalles', array('uses' => 'CorrelacionDetalleControler@Index', 'as' => 'correlaciondetalles'));
Route::get('/setting/getcorrelaciondetalles', array('uses' => 'CorrelacionDetalleControler@Getcorrelaciondetalles', 'as' => 'getcorrelaciondetalles'));
Route::get('/setting/correlaciondetalles/edit/{id}', array('uses' => 'CorrelacionDetalleControler@Edit', 'as' => 'correlaciondetallesedit'));
Route::post('/setting/correlaciondetalles/createorupdate', array('uses' => 'CorrelacionDetalleControler@CreateOrUpdate', 'as' => 'correlaciondetallecreateorupdate'));
