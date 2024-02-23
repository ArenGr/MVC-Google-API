<?php

use App\Core\Router\RouteRegister as Route;

Route::add('/', 'HomeController:index');
Route::add('/map/', 'GoogleMapsApiController:index');

Route::add('/requests/all', 'HomeController:getAll');
Route::add('/requests/store', 'HomeController:store');
Route::add('/proxy', 'ProxyController:index');
