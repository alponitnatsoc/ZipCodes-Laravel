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

/** index page */
Route::get('/', 'MainController@showIndex')->name('home');

/** match page */
Route::get('match','MainController@match')->name('match_agents');

/** match page */
Route::post('match','MainController@matchProcess')->name('match_process');

/** contacts pages */
Route::get('contacts/{agent?}','PersonController@showContacts')->name('show_contacts');

/** Resourceful routes  */
//Agent
Route::resource('agent',"AgentController");

//Person
Route::resource('person',"PersonController");

//Location
Route::resource('location',"LocationController");



Route::group(['prefix'=>'loading'],function (){
    Route::get('zipCodes',function (){
        return view('pages.loadingZipCodes');
    })->name('loading_zip_codes');

    Route::get('contacts',function (){
        return view('pages.loadingContacts');
    })->name('loading_contacts');

    Route::get('zipCodes/fail/{error}',function ($error){
        return view('pages.loadingFail',array('error'=>$error));
    })->name('loading_fail');

    Route::get('contacts/fail/{error}',function ($error){
        return view('pages.contactsLoadingFail',array('error'=>$error));
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



