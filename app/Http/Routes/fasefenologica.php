<?php
Route::post('/users/permissions', array('uses' => 'FaseFenologicaControler@PermisionsManipulation', 'as' => 'permissionsman'));
Route::get('/setting/fasefenologica', array('uses' => 'FaseFenologicaControler@Index', 'as' => 'fasefenologica'));
Route::get('/setting/getfasefenologica', array('uses' => 'FaseFenologicaControler@GetFaseFenologica', 'as' => 'getfasefenologica'));
Route::get('/setting/fasefenologica/edit/{id}', array('uses' => 'FaseFenologicaControler@Edit', 'as' => 'fasefenologicaedit'));
Route::post('/setting/fasefenologica/createorupdate', array('uses' => 'FaseFenologicaControler@CreateOrUpdate', 'as' => 'fasefenologicacreateorupdate'));
