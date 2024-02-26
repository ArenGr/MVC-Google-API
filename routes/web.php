<?php

use App\Core\Router\RouteRegister as Route;

Route::add('/', 'HomeController:index');

Route::add('/google/maps/image/', 'GoogleMapsController:getStaticImage');
Route::add('/google/maps/autocomplete/', 'GoogleMapsController:getPredictions');
Route::add('/google/maps/coordinates/', 'GoogleMapsController:getAddressDetails');

Route::add('/requests/all', 'HomeController:getAll');
Route::add('/requests/store', 'HomeController:store');