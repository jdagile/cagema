<?php
Route::post('/users/permissions', array('uses' => 'ValoresAcumuladosPorFaseFenologicaControler@PermisionsManipulation', 'as' => 'permissionsman'));
Route::get('/setting/valoresacumuladosporfasefenologicas', array('uses' => 'ValoresAcumuladosPorFaseFenologicaControler@Index', 'as' => 'valoresacumuladosporfasefenologicas'));
Route::get('/setting/getvaloresacumuladosporfasefenologicas', array('uses' => 'ValoresAcumuladosPorFaseFenologicaControler@GetValoresAcumuladosPorFaseFenologicas', 'as' => 'getvaloresacumuladosporfasefenologicas'));
Route::get('/setting/valoresacumuladosporfasefenologicas/edit/{id}', array('uses' => 'ValoresAcumuladosPorFaseFenologicaControler@Edit', 'as' => 'valoresacumuladosporfasefenologicasedit'));
Route::post('/setting/valoresacumuladosporfasefenologicas/createorupdate', array('uses' => 'ValoresAcumuladosPorFaseFenologicaControler@CreateOrUpdate', 'as' => 'valoresacumuladosporfasefenologicacreateorupdate'));
