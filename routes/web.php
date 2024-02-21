<?php

use App\Core\Router\RouteRegister as Route;

Route::add('/', 'RequestHistoryController:index');
Route::add('/map/', 'GoogleMapsApiController:index');
