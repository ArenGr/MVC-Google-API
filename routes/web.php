<?php

use App\Core\Router\RouteRegister as Route;

Route::add('/', 'HomeController:index');
Route::add('/map/', 'GoogleMapsApiController:index');

Route::add('/requests/', 'GoogleMapsApiController:getAll');
Route::add('/requests/store', 'HomeController:store');
