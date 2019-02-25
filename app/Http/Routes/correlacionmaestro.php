<?php
Route::post('/users/permissions', array('uses' => 'CorrelacionMaestroControler@PermisionsManipulation', 'as' => 'permissionsman'));
Route::get('/setting/correlacionmaestros', array('uses' => 'CorrelacionMaestroControler@Index', 'as' => 'correlacionmaestros'));
Route::get('/setting/getcorrelacionmaestros', array('uses' => 'CorrelacionMaestroControler@GetCorrelacionMaestros', 'as' => 'getcorrelacionmaestros'));
Route::get('/setting/correlacionmaestros/edit/{id}', array('uses' => 'CorrelacionMaestroControler@Edit', 'as' => 'correlacionmaestroedit'));
Route::post('/setting/correlacionmaestros/createorupdate', array('uses' => 'CorrelacionMaestroControler@CreateOrUpdate', 'as' => 'correlacionmaestrocreateorupdate'));
