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

/** Resourceful routes  */

//Agent
Route::resource('agent',"AgentController");

//Person
Route::resource('person',"PersonController");

//Location
Route::resource('location',"LocationController");



Route::get('/', 'MainController@showIndex')->name('home');


Route::group(['prefix'=>'loading'],function (){
    Route::get('/',function (){
        return view('pages.loadingZipCodes');
    })->name('loading');

    Route::get('fail/{error}',function ($error){
        return view('pages.loadingFail',array('error'=>$error));
    })->name('loading_fail');
});



Route::group(['prefix'=>'file'],function (){
    Route::get('load/{type}/{filename?}/{path?}', 'LoadCSVController@load')->name('loadCSV');
    Route::post('load/{type}/{filename?}/{path?}', 'LoadCSVController@load')->name('loadCSV');
});

Route::group(['prefix'=>'create'],function (){
    Route::post('coordinate/{latitude}/{longitude}','ZipCodeController@createCoordinate')->name('create_coordinate');
    Route::post('location/{zipcode}/{state}/{city}/{coordId}','ZipCodeController@createLocation')->name('create_location');
});





Route::get('agents','AgentController@index')->name('');

Route::get('person', function () {

    echo getcwd();
//    $person = App\Person::first();
//    echo $person->personable->agent_code.'<br>';
//
//    $person2 = App\Person::find(2);
//    echo $person2->agent->person->name;


    die;
    $coord1 = Geotools::coordinate([32.29,-110.83]);
    $coord2 = Geotools::coordinate([33.76,-112.24]);
    $distance = Geotools::distance()->setFrom($coord1)->setTo($coord2);
    echo $distance->in('Km')->haversine();
});


