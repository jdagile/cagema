<?php
Route::get('/dashbord', array('uses' => 'RegionesAlertasControler@GetalAlertaDeRegion', 'as' => 'getalertas'));
