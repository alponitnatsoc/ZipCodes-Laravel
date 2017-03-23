<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'admin'], function () {
    Route::get('users', function ()    {
        // Matches The "/admin/users" URL
    });
});

Route::get('person', function () {

    $coord1 = Geotools::coordinate([32.29,-110.83]);
    $coord2 = Geotools::coordinate([33.76,-112.24]);
    $distance = Geotools::distance()->setFrom($coord1)->setTo($coord2);
    echo $distance->in('mi')->vincenty();

});


