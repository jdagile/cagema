<?php
Route::get('/modulebuilder/menu', array('uses' => 'ModuleBuilderController@menu', 'as' => 'modulebuildermenu'));
Route::get('/modulebuilder/modulebuilderindex', array('uses' => 'ModuleBuilderController@Index', 'as' => 'modulebuilderindex'));
Route::get('/modulebuilder/builder', array('uses' => 'ModuleBuilderController@Builder', 'as' => 'builder'));
Route::get('/modules', array('uses' => 'ModuleBuilderController@Modules', 'as' => 'all_modules'));
Route::get('/modules/list', array('uses' => 'ModuleBuilderController@ModulesList', 'as' => 'moduleslist'));
Route::get('/modules/edit/{id}', array('uses' => 'ModuleBuilderController@EditModule', 'as' => 'module_edit'));
Route::get('/modules/delete/{id}', array('uses' => 'ModuleBuilderController@DeleteModule', 'as' => 'module_delete'));
Route::post('/modules/CreateUpdate', array('uses' => 'ModuleBuilderController@CreateUpdateModule', 'as' => 'module_create_update'));
Route::get('/modules/{id}', array('uses' => 'ModuleBuilderController@ConfigureModule', 'as' => 'module_configure'));
Route::get('/modules/fields/{module_id}', array('uses' => 'ModuleBuilderController@ModuleFields', 'as' => 'fieldslist'));
Route::post('/modules/fields/CreateUpdate', array('uses' => 'ModuleBuilderController@CreateUpdateField', 'as' => 'field_create_update'));
Route::get('/modules/fields/delete/{id}', array('uses' => 'ModuleBuilderController@DeleteField', 'as' => 'field_delete'));
Route::get('/modules/fields/edit/{id}', array('uses' => 'ModuleBuilderController@EditField', 'as' => 'field_edit'));
Route::get('/modulebuilder/generateview', array('uses' => 'ModuleBuilderController@GenerateView', 'as' => 'genearateview'));
Route::match(['get', 'post'], '/modulebuilder/generate/{id}', array('uses' => 'ModuleBuilderController@GenerateModule', 'as' => 'genearatemodule'));
Route::get('/modulebuilder/deletemodule', array('uses' => 'ModuleBuilderController@ModuleDelete', 'as' => 'moduledelete'));
//Route::get('/modules/generate/{id}',array('uses'=>'ModuleBuilderController@GenerateAction','as'=>'generateaction'));